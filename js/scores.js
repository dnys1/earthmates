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
	
	var blocks = d3.select("tbody")
									.selectAll(".table-score")
									.data(competencies);
	
	blocks.append("div").classed("bar-self", true);
	blocks.append("div").classed("bar-other", true);
	
	var width = d3.scaleLinear()
				.domain([0, 5])
				.range([0, 100]);
				
	var green = d3.scaleLinear()
				.domain([0, 2.5])
				.range([0, 255]);
	
	var red = d3.scaleLinear()
				.domain([2.5, 5])
				.range([0, 255]);
	
	blocks.selectAll(".bar-self").style("width", function(d) {return width(selfScores[d.ID]) + "px";});
	blocks.selectAll(".bar-other").style("width", function(d) {return width(otherScores[d.ID]) + "px";})
																.style("background-color", function(d) {
																	var score = parseFloat(otherScores[d.ID]);
																	
																	if(score < 2.5) {var r = 255; var g = parseInt(green(score));}
																	else {var r = parseInt(red(score)); var g = 255;}
																	
																	return "rgb("+r+","+g+",0)";
																})
																.text(function (d) {var score = parseFloat(otherScores[d.ID]).toFixed(1); if (score >= 1.0) return score;});
});