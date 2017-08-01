var otherLevelColors = ["rgb(253, 187, 45)", "rgb(209, 188, 75)", "rgb(165, 189, 105)",
									 "rgb(121, 191, 135)", "rgb(77, 192, 165)", "rgb(34, 193, 195)"];
var selfLevelColors = ["rgba(253, 187, 45, 0.6)", "rgba(209, 188, 75, 0.6)", "rgba(165, 189, 105, 0.6)",
									      "rgba(121, 191, 135, 0.6)", "rgba(77, 192, 165, 0.6)", "rgba(34, 193, 195, 0.6)"];
				
function roundScore(score) {
	if (score <= 4.8) return parseInt(score);
	else return 5;
}

$(document).ready(function () {	
	// Set values
	var minWidth = 20;
	var maxWidth = parseInt($(".overallScore").width());
	
	var width = d3.scaleLinear()
				.domain([0, 5])
				.range([minWidth, maxWidth]);

	// Generate score-panel overall bar chart
	var overallScore = d3.select(".overallScore");
	overallScore.append("div").classed("bar-self", true);
	overallScore.append("div").classed("bar-other", true);
	overallScore.selectAll("div").data([totalSelfScore, totalOtherScore]);
	overallScore.select(".bar-self").style("width", function (d) {return width(d) + "px"; })
																	.text(function (d) { return d; })
																	.style("background-color", function(d) {
																		 var score = roundScore(d);
																		 return selfLevelColors[score];
																	 });
	
	overallScore.select(".bar-other").style("width", function (d) {return width(d) + "px"; })
																	 .text(function (d) { return d; })
																	 .style("background-color", function(d) {
																		 var score = roundScore(d);
																		 return otherLevelColors[score];
																	 });
																	 
	overallScore.select(".bar-self").append("div")
																	.classed("marker", true).style("width",maxWidth+"px")
																	.style("border-color", function(d) {
																		var score = roundScore(d);
																		return selfLevelColors[score];
																	}).text("You");
	overallScore.select(".bar-other").append("div")
																	 .classed("marker", true).style("width",maxWidth+"px")
																	 .style("border-color", function(d) {
																		var score = roundScore(d);
																		return otherLevelColors[score];
																	 }).text("Peers");
	
});