var resourceJSONArray; // Array of JSON objects

$(document).ready(loadAllResources);

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

function replaceQuotes(text) {
  var map = {
    '“': '"',
    '”': '"'
  };

  return text.replace(/[“”]/g, function(m) { return map[m]; });
}

function loadAllResources() {
	$.ajax({
			type: 'GET',
			url: 'includes/get_resources.php',
			cache: false,
			success: function(result) {
				resourceJSONArray = JSON.parse(result);
				loadAllResourceDescriptions();
			}
	});
}

function loadAllResourceDescriptions() {
	var competencyID = $_GET['id'];
	$.ajax({
			type: 'GET',
			url: 'includes/get_resource_descriptions.php',
			data: 'id='+competencyID,
			cache: false,
			success: function(result) {
				// If it returns an empty array
				if (result == "[]")
				{
					$("#spinner").html("There don't appear to be any resources for this competency, yet.");
					$("#spinner").removeClass("fa");
					$("#spinner").removeClass("fa-spinner");
					$("#spinner").removeClass("fa-spin");
					return;
				}
				
				var json = JSON.parse(result);
				
				for (var i = 0; i < json.length; i++)
				{
					var div = "";
					var resourceID = json[i].ResourceID;
					var resourceIndex = resourceID - 1; // working with arrays not db indexes
					var title = resourceJSONArray[resourceIndex].Title;
					var subtitle = resourceJSONArray[resourceIndex].Subtitle;
					var author = resourceJSONArray[resourceIndex].Author;
					var imageLink = resourceJSONArray[resourceIndex].ImageLink;
					var description = json[i].Description;
					var quoteArray = replaceQuotes(json[i].QuoteArray);
					quoteArray = JSON.parse(quoteArray);
					
					// Create the resource div
					div += '<div class="resource" id="resource' + i + '">';
					div += '<img src="' + imageLink + '" class="cover pull-left" alt="' + title + '" />';
					div += '<h3 class="title">' + title;
					if (subtitle) div += ' <small>' + subtitle + '</small>';
					div += '</h3>';
					div += '<h4 class="author"><i>' + author + '</i></h4>';
					if (description) div += '<p class="description">' + description + '</p>';
					if (quoteArray) {
						div += '<blockquote>';
						quoteArray.forEach(function(item, index) {
							div += '<p class="quote">' + item + '</p>';
						});
						div += '</blockquote>';
					}
					div += '</div>';
					
					if (i == 0) removeSpinner();
					
					// Embed the resource div
					$("#resourcePanel").append(div);
				}
			},
			error: function() {
				$("#spinner").html("There don't appear to be any resources for this competency, yet.");
				$("#spinner").removeClass("fa");
				$("#spinner").removeClass("fa-spinner");
				$("#spinner").removeClass("fa-spin");
			}
	});
}

function removeSpinner() {
	$("#spinner").remove();
}