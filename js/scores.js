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

$(document).ready(function() {
	loadCompetencyData();
	$("tbody .table-score").append('<span class="fa fa-spinner fa-spin spinner"></span>');
	
	$('.infoMessage').on('closed.bs.alert', function () {
		console.log('closed info message');
	})
});

$(document).ajaxStop(function() {	
	var otherLevelColors = ["rgb(253, 187, 45)", "rgb(209, 188, 75)", "rgb(165, 189, 105)",
									 "rgb(121, 191, 135)", "rgb(77, 192, 165)", "rgb(34, 193, 195)"];
	var selfLevelColors = ["rgba(253, 187, 45, 0.6)", "rgba(209, 188, 75, 0.6)", "rgba(165, 189, 105, 0.6)",
									      "rgba(121, 191, 135, 0.6)", "rgba(77, 192, 165, 0.6)", "rgba(34, 193, 195, 0.6)"];
	
	var minWidth = 12;
	var maxWidth = $(".table-score").width();
	
	var width = d3.scaleLinear()
				.domain([0, 5])
				.range([minWidth, maxWidth]);

	function roundScore(score) {
		if (score <= 4.8) return parseInt(score);
		else return 5;
	}
	
	$(".spinner").remove();
		
	var blocks = d3.selectAll(".table-score:empty")
									.data(competencies);
	
	blocks.append("div").classed("bar-self", true);
	blocks.append("div").classed("bar-other", true);
	
	blocks.selectAll(".bar-self").style("width", function(d) {return width(roundScore(selfScores[d.ID])) + "px";})
															 .style("background-color", function(d) {
																	var score = roundScore(selfScores[d.ID]);
																	return selfLevelColors[score];
																})
															 .text(function(d) { return roundScore(selfScores[d.ID]); });
															 
	blocks.selectAll(".bar-other").style("width", function(d) {return width(roundScore(otherScores[d.ID])) + "px";})
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
																}).text(function(d) {
																	if(roundScore(selfScores[d.ID]) == 5) return "";
																	else return "5";
																});
																
	blocks.selectAll(".bar-other").append("div").classed("marker",true)
																.style("width", maxWidth + "px")
																.style("border-color", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	return otherLevelColors[score];
																}).text(function(d) {
																	if(roundScore(otherScores[d.ID]) == 5) return "";
																	else return "5";
																});										
});