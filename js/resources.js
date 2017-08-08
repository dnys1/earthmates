/** RATING SYSTEM **/
(function() {

  'use strict';

  /**
   * rating
   * 
   * @description The rating component.
   * @param {HTMLElement} el The HTMl element to build the rating widget on
   * @param {Number} currentRating The current rating value
   * @param {Number} maxRating The max rating for the widget
   * @param {Function} callback The optional callback to run after set rating
   * @return {Object} Some public methods
   */
  function rating(el, currentRating, maxRating, callback, resourceID, index) {
    
    /**
     * stars
     * 
     * @description The collection of stars in the rating.
     * @type {Array}
     */
    var stars = [];

    /**
     * init
     *
     * @description Initializes the rating widget. Returns nothing.
     */
    (function init() {
      if (!el) { throw Error('No element supplied.'); }
      if (!maxRating) { throw Error('No max rating supplied.'); }
      if (!currentRating) { currentRating = 0; }
      if (currentRating < 0 || currentRating > maxRating) { throw Error('Current rating is out of bounds.'); }

      for (var i = 0; i < maxRating; i++) {
        var star = document.createElement('li');
        star.classList.add('c-rating__item');
        star.setAttribute('data-index', i);
        if (i < currentRating) { star.classList.add('is-active'); }
        el.appendChild(star);
        stars.push(star);
        attachStarEvents(star);
      }
    })();

    /**
     * iterate
     *
     * @description A simple iterator used to loop over the stars collection.
     *   Returns nothing.
     * @param {Array} collection The collection to be iterated
     * @param {Function} callback The callback to run on items in the collection
     */
    function iterate(collection, callback) {
      for (var i = 0; i < collection.length; i++) {
        var item = collection[i];
        callback(item, i);
      }
    }

    /**
     * attachStarEvents
     *
     * @description Attaches events to each star in the collection. Returns
     *   nothing.
     * @param {HTMLElement} star The star element
     */
    function attachStarEvents(star) {
      starMouseOver(star);
      starMouseOut(star);
      starClick(star);
    }

    /**
     * starMouseOver
     *
     * @description The mouseover event for the star. Returns nothing.
     * @param {HTMLElement} star The star element
     */
    function starMouseOver(star) {
      star.addEventListener('mouseover', function(e) {
        iterate(stars, function(item, index) {
          if (index <= parseInt(star.getAttribute('data-index'))) {
            item.classList.add('is-active');
          } else {
            item.classList.remove('is-active');
          }
        });
      });
    }

    /**
     * starMouseOut
     *
     * @description The mouseout event for the star. Returns nothing.
     * @param {HTMLElement} star The star element
     */
    function starMouseOut(star) {
      star.addEventListener('mouseout', function(e) {
        if (stars.indexOf(e.relatedTarget) === -1) {
          setRating(null, false);
        }
      });
    }

    /**
     * starClick
     *
     * @description The click event for the star. Returns nothing.
     * @param {HTMLElement} star The star element
     */
    function starClick(star) {
      star.addEventListener('click', function(e) {
        e.preventDefault();
        setRating(parseInt(star.getAttribute('data-index')) + 1, true);
      });
    }

    /**
     * setRating
     *
     * @description Sets and updates the currentRating of the widget, and runs
     *   the callback if supplied. Returns nothing.
     * @param {Number} value The number to set the rating to
     * @param {Boolean} doCallback A boolean to determine whether to run the
     *   callback or not
     */
    function setRating(value, doCallback) {
      if (value && value < 0 || value > maxRating) { return; }
      if (doCallback === undefined) { doCallback = true; }

      currentRating = value || currentRating;

      iterate(stars, function(star, index) {
        if (index < currentRating) {
          star.classList.add('is-active');
        } else {
          star.classList.remove('is-active');
        }
      });

      if (callback && doCallback) { callback(getRating(), resourceID, index); }
    }

    /**
     * getRating
     *
     * @description Gets the current rating.
     * @return {Number} The current rating
     */
    function getRating() {
      return currentRating;
    }

    /**
     * Returns the setRating and getRating methods
     */
    return {
      setRating: setRating,
      getRating: getRating
    };

  }

  /**
   * Add to global namespace
   */
  window.rating = rating;

})();

/** END RATING SYSTEM **/

var resources = [];
var categories = [];
var types = [];

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function loadResources(category = 0, subcategory = 0, type = 0)
{
	resources = [];
	$("table>tbody").empty();
	
	$.ajax({
		type:'GET',
		url: 'includes/get_resources.php',
		data: {cat: category, sub: subcategory, typ: type},
		cache: false,
		success: function(result) {
			if(result)
			{
				resources = JSON.parse(result);
				
				if(resources.length == 0)
				{
					$(".resources-table").hide();
					$("#resources-message").hide();
					$("#no-resources").show();
				}
				else {
					$("#resources-message").hide();
					$(".resources-table").show();
					$("#no-resources").hide();
					
					for (var i = 0; i < resources.length; i++)
					{
						var subtitle = (resources[i].Subtitle == null) ? "" : resources[i].Subtitle;
						var description = (resources[i].Description == null) ? "Description not available." : resources[i].Description;
						var cover;
						switch(type)
						{
							case "1":
								cover = resources[i].AmazonReferral;
								break;
							case "2":
								if (resources[i].AmazonLink != null) {
									cover = '<a target="_blank" href="' + resources[i].AmazonLink + '"><img class="img-responsive" src="' + resources[i].ImageLink + '" />';
								}
								else {
									cover = '<img class="img-responsive" src="' + resources[i].ImageLink + '" />';
								}
								var html = "";
								break;
							case "3":
								console.log("web");
								break;
							case "4":
								console.log("article");
								break;
						}
						
						var html = "";
						html += '<tr>';
						
						html += '<td><div class="referral">' + cover + '</div></td>';
						
						html += '<td>';
						html += '<div class="description">';
						html += '<h2>' + resources[i].Title + ' <small>' + subtitle + '</small></h3>';
						html += '<p><i>' + resources[i].Author + '</i></p>';
						
						html += '<p class="resource-description">' + description + "</p>";
						html += '<p class="resource-links">';
						if (resources[i].AmazonLink != null) {
							html += '<a target="_blank" href="' + resources[i].AmazonLink + '">Amazon</a>&emsp;';
						}
						if (resources[i].WebLink != null) {
							html += '<a target="_blank" href="' + resources[i].WebLink + '">Author\'s Site</a>';
						}
						html += '</p>';
						html += '</div>';
						html += '</td>';
						
						html += '<td class="rating"><div class="center-block">';
						html += '<p class="tiny-description"><b>' + resources[i].Title + '</b><br>' + resources[i].Author + '<br></p>';
						html += '<ul class="c-rating"></ul>';
						html += '<p class="rating-info"></p>';
						html += '</div></td>';
						
						html += '</tr>';
						$("table>tbody").append(html);
						$("table a").attr("target", "_blank");
					}
					
					resize();
					
					var ratings = $(".rating .c-rating");
					var rating_infos = $(".rating .rating-info");
					for (var i = 0; i < ratings.length; i++)
					{
						var index = i;
						var el = ratings[i];
						var currentRating = resources[i].Rating;
						var maxRating = 5;
						var resourceID = resources[i].ID;
						var callback = function(rating, resourceID, index) { postRating(parseInt(resourceID), rating, index); };
						var myRating = rating(el, currentRating, maxRating, callback, resourceID, index);
						
						// Append the rating count
						var count = resources[i].RatingCount;
						rating_infos[i].innerHTML = (count == 1 ? "1 rating" : (count == 0 ? "No ratings" : count + " ratings"));
					}
				}
			}
		}
	});
}

function postRating(resource, rating, index)
{	
	$.ajax({
		type: "POST",
		url: 'includes/post_resource_rating.php',
		data: {resource: resource, rating: rating},
		success: function(data) {
			console.log("Setting data for resource " + resource);
			var ratings = $(".rating-info");
			ratings[index].innerHTML = data;
		}
	});
}

function loadTypes()
{
	$.ajax({
		type: 'GET',
		url: 'includes/get_types.php',
		cache: false,
		success: function(result) {
			types = JSON.parse(result);
		}
	});
}

function loadCategories()
{
	$.ajax({
		type: 'GET',
		url: 'includes/get_categories.php',
		cache: false,
		success: function(result) {
			categories = JSON.parse(result);
		}
	});
}

function fillCategories()
{
	$("#categories").append('<option data-index="-1" value="0" selected="selected"></option>');
	$("#categories").append('<option data-index="-1" value="all">All</option>');
	for(var i = 0; i < categories.length; i++)
	{
		$("#categories").append('<option data-index="' +i+'" value="'+categories[i].ID+'">'+categories[i].Category+'</option>');
	}
}

function fillSubcategories()
{	
	var index = $("#categories").find(":selected").data("index");
	if(index != -1)
	{	
		var subcategories = categories[index].Subcategories;
		$("#subcategories").append('<option data-index="-1" value="0" selected="selected"></option>');
		$("#subcategories").append('<option data-index="-1" value="all">All</option>');
		for(var i = 0; i < subcategories.length; i++)
		{
			$("#subcategories").append('<option data-index="' +i+'" value="'+subcategories[i].ID+'">'+subcategories[i].Subcategory+'</option>');
		}
		
		$(".subcategories").show();
	}
}

function fillTypes()
{
	if($("#subcategories").val() == 0 && $("#categories").val() != 0)
	{
		return;
	}
	
	$("#types").append('<option data-index="-1" value="0" selected="selected"></option>');
	for (var i = 0; i < types.length; i++)
	{
		$("#types").append('<option data-index="' +i+'" value="'+types[i].ID+'">'+types[i].Type+'</option>');
	}
	$(".types").show();
}

function fillResources()
{
	var category = $("#categories").val();
	var subcategory = $("#subcategories").val();
	var type = $("#types").val();
	
	if(subcategory == 0 && type == 0)
		return;
	else if (type == 0 || type == null)
		return;
	
	loadResources(category, subcategory, type);
}

$(document).ready(function() {
	loadCategories();
	loadTypes();
	
	$(".subcategories").hide();
	$(".types").hide();
	
	$(".resources-table").hide();
	$("#no-resources").hide();
	$("#resources-message").show();
	
	$(window).on('resize', resize);
	window.addEventListener("orientationchange", resize, false);
});

function resize() {
	var width = $(window).width();
	console.log(width);
	if(width < 700)
	{
		console.log("here");
		$(".resources-table>tbody>tr>td:nth-of-type(2)").hide();
		$(".resources-table>thead>tr>th:nth-of-type(2)").hide();
		$(".tiny-description").show();
		
		var ratingWidth, maxImageWidth = 0;
		var imgs = $(".resources-table img");
		for (var i = 0; i < imgs.length; i++)
		{
			var currentWidth = imgs[i].width;
			if (currentWidth > maxImageWidth)
				maxImageWidth = currentWidth;
		}
		ratingWidth = width - maxImageWidth;
		$(".rating").width(ratingWidth);
	} else {
		$(".rating").width(150);
		$(".resources-table>tbody>tr>td:nth-of-type(2)").show();
		$(".resources-table>thead>tr>th:nth-of-type(2)").show();
		$(".tiny-description").hide();
	}
}

$(document).ajaxStop(function () {
	// Display all loaded resources
	var table = $(".resources-table");
	
	if($("#categories").is(":empty")) 
		fillCategories();
	
	$("#categories").change(function() {
		console.log("Category changed");
				
		$("#subcategories").empty();
		$(".subcategories").hide();
		$("#types").empty();
		$(".types").hide();
		
		if($("#categories").val() == 0)
			return;
		
		fillSubcategories();
		fillTypes();
		fillResources();
	});
	
	$("#subcategories").change(function() {
		console.log("Subcategory changed");
		
		$("#types").empty();
		$(".types").hide();
		
		if($("#subcategories").val() == 0)
			return;
		fillTypes();
		fillResources();
	});
	
	$("#types").one('change', function () {
		console.log("Type changed");
		
		if($("#types").val() == 0)
			return;
		fillResources();
	});
});