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
});

$(document).ajaxStop(function() {
	$(".spinner").remove();
	
	var levelColors = ["rgb(253, 187, 45)", "rgb(209, 188, 75)", "rgb(165, 189, 105)",
										 "rgb(121, 191, 135)", "rgb(77, 192, 165)", "rgb(34, 193, 195)"];
	
	var blocks = d3.select("tbody")
									.selectAll(".table-score")
									.data(competencies);
	
	blocks.append("div").classed("bar-self", true);
	blocks.append("div").classed("bar-other", true);
	
	var width = d3.scaleLinear()
				.domain([0, 5])
				.range([12, 112]);
				
	var green = d3.scaleLinear()
				.domain([0, 2.5])
				.range([0, 255]);
	
	var red = d3.scaleLinear()
				.domain([2.5, 5])
				.range([255, 0]);
				
	function roundScore(score) {
		if (score <= 4.8) return parseInt(score);
		else return 5;
	}
	
	blocks.selectAll(".bar-self").style("width", function(d) {return width(roundScore(selfScores[d.ID])) + "px";})
																.text(function(d) { return roundScore(selfScores[d.ID]); });
	blocks.selectAll(".bar-other").style("width", function(d) {return width(roundScore(otherScores[d.ID])) + "px";})
																.style("background-color", function(d) {
																	var score = roundScore(otherScores[d.ID]);
																	return levelColors[score];
																})
																.text(function (d) {return roundScore(otherScores[d.ID]);});
});