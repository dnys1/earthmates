var page = 0, rows, resultsPerPage, pageCount;
var blocks, scores = [];
$(document).ready(function() {
	if (results)
	{
		results = JSON.parse(results);
		resultsPerPage = 5;
		pageCount = Math.floor(results.length / resultsPerPage);
	
		rows = $(".search-table>tbody>tr");
	
		$(".previous>a").disable(true);
		if(results.length <= 5) 
				$(".next>a").disable(true);
			
		$(".previous>a").on('click', loadPrevious);
		$(".next>a").on('click', loadNext);
		
		if ($(".results-score").length > 0)
		{
			blocks = $(".results-score");
			for (var i = 0; i < blocks.length; i++)
			{
				scores[i] = parseFloat(blocks[i].innerText);
			}
			colorScores();
			
			$(window).on('resize', colorScores);
			// Listen for orientation changes      
			window.addEventListener("orientationchange", colorScores, false);
		}
	}
});

function loadPrevious()
{
	$(".previous>a").disable(true);
	$(".next>a").disable(true);
	
	if(page > 0)
	{
		page--;
		var start = page * resultsPerPage;
		
		console.log(page);
		console.log(start);
		
		rows.empty();
		
		for (var i = 0; i < rows.length; i++)
		{
			var profile = results[start+i];
			var html = "";
			html += "<td>";
			html += '<img src="profile_image.php?id=' + profile.ID + '" class="img-responsive" />';
			html += '</td>';
			if (parseInt(profile.GlobalProfile))
			{
				html += '<td><a href="view_profile.php?id=' + profile.ID + '">' + profile.FirstName + " " + profile.LastName + '</a></td>';
				html += '<td class="results-score">' + (profile.AvgScore ? profile.AvgScore.toFixed(1) : 'N/A' ) + '</td>';
			}
			else
			{
				html += '<td title="This user does not allow others to view their EarthMates profile.">' + profile.FirstName + " " + profile.LastName + '</td>';
				html += '<td title="This user does not allow others to view their EarthMates profile.">N/A</td>';
			}
			
			rows[i].innerHTML = html;
		}
		
		// Collect scores
		blocks = $(".results-score");
		scores = [];
		for (var i = 0; i < blocks.length; i++)
		{
			scores[i] = parseFloat(blocks[i].innerText);
		}
		colorScores();
		
		// Reset page navigators
		if (page > 0) {
			$(".previous>a").disable(false);
		}
		$(".next>a").disable(false);
	}
}

function loadNext() 
{
	$(".previous>a").disable(true);
	$(".next>a").disable(true);
	
	if(page < pageCount)
	{
		page++;
		var start = page * resultsPerPage, end;
		
		if (start + rows.length <= results.length)
			end = rows.length;
		else
			end = results.length - start;
		
		console.log(page);
		console.log(start);
		console.log(end);
		
		rows.empty();
		
		for (var i = 0; i < end; i++)
		{
			var profile = results[start+i];
			var html = "";
			html += "<td>";
			html += '<img id="image' + i +'" src="profile_image.php?id=' + profile.ID + '" class="img-responsive" />';
			html += '</td>';
			if (parseInt(profile.GlobalProfile))
			{
				html += '<td><a href="view_profile.php?id=' + profile.ID + '">' + profile.FirstName + " " + profile.LastName + '</a></td>';
				html += '<td class="results-score">' + (profile.AvgScore ? profile.AvgScore.toFixed(1) : 'N/A' ) + '</td>';
			}
			else
			{
				html += '<td title="This user does not allow others to view their EarthMates profile.">' + profile.FirstName + " " + profile.LastName + '</td>';
				html += '<td title="This user does not allow others to view their EarthMates profile.">N/A</td>';
			}
			
			rows[i].innerHTML = html;
		}
		
		// Collect scores
		blocks = $(".results-score");
		scores = [];
		for (var i = 0; i < blocks.length; i++)
		{
			scores[i] = parseFloat(blocks[i].innerText);
		}
		colorScores();
		
		// Reset page navigators
		if (page < pageCount)
		{
			$(".next>a").disable(false);
		}
		$(".previous>a").disable(false);
	}
}

function resizeImage(elementID) 
{
	var img = document.getElementById(elementID);
	var height = img.clientHeight;
	var width = img.clientWidth;
	
	if (width > height)
	{
		var base = height / 5;
		var xClip = Math.round((width - 4 * base) / 2);
		$(img).css('clip-path', 'inset(0 ' + xClip + 'px 0 ' + xClip + 'px)');
	} else {
		var base = width / 4;
	}
}

var otherLevelColors = ["rgb(253, 187, 45)", "rgb(209, 188, 75)", "rgb(165, 189, 105)",
								 "rgb(121, 191, 135)", "rgb(77, 192, 165)", "rgb(34, 193, 195)"];
var selfLevelColors = ["rgba(253, 187, 45, 0.6)", "rgba(209, 188, 75, 0.6)", "rgba(165, 189, 105, 0.6)",
											"rgba(121, 191, 135, 0.6)", "rgba(77, 192, 165, 0.6)", "rgba(34, 193, 195, 0.6)"];
											
function roundScore(score) {
	if (score <= 4.8) return parseInt(score);
	else return 5;
}

var width, minWidth, maxWidth; // Width scale function and min/max vals
var blocks;

function colorScores()
{
	// Start fresh
	$(".results-score").empty();
	
	minWidth = 12;
	maxWidth = $(".results-score").width();
	
	width = d3.scaleLinear()
				.domain([0, 5])
				.range([minWidth, maxWidth]);
	
	blocks = d3.selectAll(".results-score").data(scores).append("div").classed("bar-other", true);
	
	if (maxWidth < 50)
	{
		console.log("Too small!");
	}
	
	blocks.style("width", function(d) { return width(d) + "px"; })
				.style("background-color", function(d) {
					var score = roundScore(d);
					return otherLevelColors[score];
				}).text(function(d) { return d; });
	
	blocks.append("div").classed("marker", true)
				.style("width", maxWidth + "px")
				.style("border-color", function (d) {
					var score = roundScore(d);
					return otherLevelColors[score];
				}).text(function (d){
					if(roundScore(d) == 5) return "";
					else return "5";
				});
}

jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            this.disabled = state;
        });
    }
});