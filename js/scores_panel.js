var otherLevelColors = ["rgb(253, 187, 45)", "rgb(209, 188, 75)", "rgb(165, 189, 105)",
									 "rgb(121, 191, 135)", "rgb(77, 192, 165)", "rgb(34, 193, 195)"];
var selfLevelColors = ["rgba(253, 187, 45, 0.6)", "rgba(209, 188, 75, 0.6)", "rgba(165, 189, 105, 0.6)",
									      "rgba(121, 191, 135, 0.6)", "rgba(77, 192, 165, 0.6)", "rgba(34, 193, 195, 0.6)"];
				
function roundScore(score) {
	if (score <= 4.8) return parseInt(score);
	else return 5;
}

var overallWidth, overallMinWidth, overallMaxWidth;
var overallScore;
var topText;

$(function () {
	// Set values
	overallMinWidth = 20;
	overallMaxWidth = parseInt($(".overallScore").width());
	if(other) topText = "Them"; else topText = "You";
	
	overallWidth = d3.scaleLinear()
				.domain([0, 5])
				.range([overallMinWidth, overallMaxWidth]);

	// Generate score-panel overall bar chart
	overallScore = d3.select(".overallScore");
	overallScore.append("div").classed("bar-self", true);
	overallScore.append("div").classed("bar-other", true);
	overallScore.selectAll("div").data([totalSelfScore, totalOtherScore]);
	overallScore.select(".bar-self").style("width", function (d) {return overallWidth(d) + "px"; })
																	.text(function (d) { return d; })
																	.style("background-color", function(d) {
																		 var score = roundScore(d);
																		 return selfLevelColors[score];
																	 });
	
	overallScore.select(".bar-other").style("width", function (d) {return overallWidth(d) + "px"; })
																	 .text(function (d) { return d; })
																	 .style("background-color", function(d) {
																		 var score = roundScore(d);
																		 return otherLevelColors[score];
																	 });
																	 
	overallScore.select(".bar-self").append("div")
																	.classed("marker", true).style("width",overallMaxWidth+"px")
																	.style("border-color", function(d) {
																		var score = roundScore(d);
																		return selfLevelColors[score];
																	}).style("opacity", function(d) {
																		var score = roundScore(d);
																		if(score == 5) return "0";
																		else return "1.0";
																	}).text(topText);
																	
	overallScore.select(".bar-other").append("div")
																	 .classed("marker", true).style("width",overallMaxWidth+"px")
																	 .style("border-color", function(d) {
																		var score = roundScore(d);
																		return otherLevelColors[score];
																	 }).style("opacity", function(d) {
																		var score = roundScore(d);
																		if(score == 5) return "0";
																		else return "1.0";
																	}).text("Peers");
	
	$(window).on('resize', overallResize);
	// Listen for orientation changes      
	window.addEventListener("orientationchange", overallResize, false);
});

function overallResize() {
	overallMinWidth = 20;
	overallMaxWidth = parseInt($(".overallScore").width());
	overallWidth = d3.scaleLinear()
				.domain([0, 5])
				.range([overallMinWidth, overallMaxWidth]);
				
	$(".overallScore>.bar-self").empty();
	$(".overallScore>.bar-other").empty();
				
	overallScore.select(".bar-self").style("width", function (d) {return overallWidth(d) + "px"; })
																	.text(function (d) { return d; })
																	.style("background-color", function(d) {
																		 var score = roundScore(d);
																		 return selfLevelColors[score];
																	 });
	
	overallScore.select(".bar-other").style("width", function (d) {return overallWidth(d) + "px"; })
																	 .text(function (d) { return d; })
																	 .style("background-color", function(d) {
																		 var score = roundScore(d);
																		 return otherLevelColors[score];
																	 });
																	 
	overallScore.select(".bar-self").append("div")
																	.classed("marker", true).style("width",overallMaxWidth+"px")
																	.style("border-color", function(d) {
																		var score = roundScore(d);
																		return selfLevelColors[score];
																	}).style("opacity", function(d) {
																		var score = roundScore(d);
																		if(score == 5) return "0";
																		else return "1.0";
																	}).text(topText);
																	
	overallScore.select(".bar-other").append("div")
																	 .classed("marker", true).style("width",overallMaxWidth+"px")
																	 .style("border-color", function(d) {
																		var score = roundScore(d);
																		return otherLevelColors[score];
																	 }).style("opacity", function(d) {
																		var score = roundScore(d);
																		if(score == 5) return "0";
																		else return "1.0";
																	 }).text("Peers");
	
	if($(".overallScore").width() < 200) {
		$(".overallScore .bar-self").css('font-size', '16px');
		$(".overallScore .bar-other").css('font-size', '16px');
		$(".overallScore .marker").css('font-size', '16px');
	} else {
		$(".overallScore .bar-self").css('font-size', '20px');
		$(".overallScore .bar-other").css('font-size', '20px');
		$(".overallScore .marker").css('font-size', '20px');
	}
}