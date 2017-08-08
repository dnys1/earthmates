var competencies = [];
var selfScores = [];
var otherScores = [];

function loadCompetencyData() {
	// Get all competencies
	$.ajax({
		type: 'GET',
		url: 'includes/get_competencies.php',
		cache: false,
		success: function(result) {
			var json = JSON.parse(result);
			for (var i = 0; i < json.length; i++)
			{
				competencies[i] = {ID: json[i].ID, Competency: json[i].Competency};
			}
		}
	});

	// Get self competency scores
	$.ajax({
		type: 'GET',
		url: 'includes/get_competency_scores.php',
		data: {other: 'false'},
		cache: false,
		success: function(result) {
			var json = JSON.parse(result);
			for (var i = 0; i < json.length; i++)
			{
				var id = json[i].CompetencyID;
				selfScores[id] = json[i].CompetencyScore;
			}
		}
	});
	
	// Get other competency scores
	$.ajax({
		type: 'GET',
		url: 'includes/get_competency_scores.php',
		data: {other: 'true'},
		cache: false,
		success: function(result) {
			var json = JSON.parse(result);
			for (var i = 0; i < json.length; i++)
			{
				var id = json[i].CompetencyID;
				otherScores[id] = json[i].CompetencyScore;
			}
		}
	});
}

/****************************/

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

$(document).ready(function() {
	loadCompetencyData();
	$("tbody .table-score").append('<span class="fa fa-spinner fa-spin spinner"></span>');
	
	minWidth = 12;
	maxWidth = $(".table-score").width();
	
	width = d3.scaleLinear()
				.domain([0, 5])
				.range([minWidth, maxWidth]);
});

$(document).ajaxStop(function() {		
	$(".spinner").remove();
		
	blocks = d3.selectAll(".table-score:empty")
									.data(competencies);
	
	blocks.append("div").classed("bar-self", true);
	blocks.append("div").classed("bar-other", true);
	
	blocks.selectAll(".bar-self").style("width", function(d) {return width(selfScores[d.ID]) + "px";})
															 .style("background-color", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	return selfLevelColors[score];
																})
															 .text(function(d) { return roundScore(selfScores[d.ID]); });
															 
	blocks.selectAll(".bar-other").style("width", function(d) {return width(otherScores[d.ID]) + "px";})
																.style("background-color", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	return otherLevelColors[score];
																})
																.text(function (d) {return roundScore(otherScores[d.ID]);});

	blocks.selectAll(".bar-self").append("div").classed("marker",true)
															 .style("width", maxWidth + "px")
															 .style("border-color", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	return selfLevelColors[score];
																}).style("opacity", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	if(score == 5) return "0";
																	else return "1.0";
																}).text("5");
																
	blocks.selectAll(".bar-other").append("div").classed("marker",true)
																.style("width", maxWidth + "px")
																.style("border-color", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	return otherLevelColors[score];
																}).style("opacity", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	if(score == 5) return "0";
																	else return "1.0";
																}).text("5");		
																
	$(window).on('resize', resize);
	// Listen for orientation changes      
	window.addEventListener("orientationchange", resize, false);
});

function resize() {
	minWidth = 12;
	maxWidth = $(".table-score").width();
	
	width = d3.scaleLinear()
				.domain([0, 5])
				.range([minWidth, maxWidth]);
				
	$(".score-table .bar-self").empty();
	$(".score-table .bar-other").empty();
	
	blocks.selectAll(".bar-self").style("width", function(d) {return width(selfScores[d.ID]) + "px";})
															 .style("background-color", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	return selfLevelColors[score];
																})
															 .text(function(d) { return roundScore(selfScores[d.ID]); });
															 
	blocks.selectAll(".bar-other").style("width", function(d) {return width(otherScores[d.ID]) + "px";})
																.style("background-color", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	return otherLevelColors[score];
																})
																.text(function (d) {return roundScore(otherScores[d.ID]);});

	blocks.selectAll(".bar-self").append("div").classed("marker",true)
															 .style("width", maxWidth + "px")
															 .style("border-color", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	return selfLevelColors[score];
																}).style("opacity", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	if(score == 5) return "0";
																	else return "1.0";
																}).text("5");
																
	blocks.selectAll(".bar-other").append("div").classed("marker",true)
																.style("width", maxWidth + "px")
																.style("border-color", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	return otherLevelColors[score];
																}).style("opacity", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	if(score == 5) return "0";
																	else return "1.0";
																}).text("5");
}