var competencies = [];
var selfScores = [];
var otherScores = [];

function loadCompetencyData() {
	// Get all competencies
	$.ajax({
		type: 'GET',
		url: 'ajax/get_competencies.php',
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
		url: 'ajax/get_competency_scores.php',
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
		url: 'ajax/get_competency_scores.php',
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

$(function() {
	loadCompetencyData();
	$("tbody .table-score").append('<span class="fa fa-spinner fa-spin spinner"></span>');
	
	minWidth = 12;
	maxWidth = $(".table-score").width();
	
	width = d3.scaleLinear()
				.domain([0, 5])
				.range([minWidth, maxWidth]);

	$("#dashboardTour").click(function () {
		if (typeof dashboardTour === 'undefined') {
			var dashboardTour = new Tour({
			name: "dashboard",
			smartPlacement: false,
			steps: [
			{
				title: "Welcome to your dashboard!",
				content: "This is the main landing page of your profile. It houses all your scoring information.",
				orphan: true
			},
			{
				element: "#dropdown-toggle",
				title: "Your Dashboard",
				content: "It is accessible always from the dropdown menu.",
				backdropContainer: 'nav',
				placement: 'left'
			},
			{
				element: "#dropdown-toggle",
				title: "Resources",
				content: "You can also now view our 'Resources' section which will help you on your journey.",
				backdropContainer: 'nav',
				placement: 'left'
			},
			{
				element: "#overallScoreHeading",
				title: "Your Overall Score",
				content: "These are the averages of your individual scores.",
				placement: 'top'
			},
			{
				element: "#overallScore",
				title: "Your Overall Score",
				content: "Your self average is on top, and the average of your peers' scores is on bottom.",
				placement: 'top'
			},
			{
				element: "#overallScore",
				title: "Your Overall Score",
				content: "This trend is exhibited across the site.",
				placement: 'top'
			},
			{
				element: "#scoreDescriptions",
				title: "Score Descriptions",
				content: "In general, we designed the scoring system to follow a pattern with 0 at the lower end and 5 at the upper.",
				placement: 'top'
			},
			{
				element: "#competencies",
				title: "Individual Competencies",
				content: "Here you'll find a breakdown of your score, separated into 16 individual competencies.",
				placement: 'top'
			},
			{
				element: "#competencies",
				title: "Individual Competencies",
				content: "We believe this set of values encompasses a wide range of the human experience.",
				placement: 'top'
			},
			{
				element: "#firstCompetency",
				title: "Individual Competencies",
				content: "Clicking on an individual competency will bring you to it's information page. Click on one to explore.",
				placement: 'top'
			}],
			storage: false,
			backdrop: true
			});

			// Initialize the tour
			dashboardTour.init();
			
			// Start the tour
			dashboardTour.start();
		}
	});
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