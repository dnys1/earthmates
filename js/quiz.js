var numQuestions;
var answersArray = [null];
var idArray = [null];
var q = 1;

$(document).ready(function() {
	$("#quizContainer").hide();
	getNumQuestions();
	
	$("#startButton").click(function() {
		$("#welcomeScreen").hide();
		loadQuestion(q);
		$("#quizContainer").show();
		$("#submitQuiz").hide();
		$("#nextQuestion").removeClass("disabled");
		$("#prevQuestion").addClass("disabled");
	});
	
	$("#prevQuestion").click(function() {
		if(q>1) {
			// Check if radio is marked
			if($('form input[type=radio]:checked').val()) {
				// Record answer to array
				answersArray[q] = getCheckedValue();
			}
			
			// Unmark all radio buttons
			$("input[name=answerRadio]").prop("checked", false);
			
			// Load previous question
			loadQuestion(--q);
			}			
	});
	
	$("#nextQuestion").click(function() {
		if(q<numQuestions) {
			if(!$('form input[type=radio]:checked').val()) {
				alert('Nothing is checked');
			} else {
				// Record answer to array
				answersArray[q] = getCheckedValue();
				
				// Unmark all radio buttons
				$("input[name=answerRadio]").prop("checked", false);
				
				// Load next question
				loadQuestion(++q);
			}
		}
	});
	
	// Submit the quiz
	// Load the answers array into
	// the POST variable "answers"
	$("#submitQuiz").click(function() {
		if(!$('form input[type=radio]:checked').val()) {
			alert('Nothing is checked');
		}
		else {
			$("input[name='answers']").val(JSON.stringify(answersArray));
			$("form#quizForm").submit();
		}
	});
});

function loadQuestion(question) {
	$.ajax({
			type: 'GET',
			url: 'includes/get_question.php',
			data: 'q=' + question,
			cache: false,
			success: function(result) {
				var json = JSON.parse(result);
				$("#question").html(json.Question);
			}
	});
	
	// Ensure proper buttons are shown/hidden
	// I.e. previous button not needed at the start
	// Toggled disabled
	if (question == 1) {
		$("#submitQuiz").hide();
		$("#nextQuestion").removeClass("disabled");
		$("#prevQuestion").addClass("disabled");
	}
	else if (question == numQuestions) {
		$("#submitQuiz").show();
		$("#nextQuestion").addClass("disabled");
		$("#prevQuestion").removeClass("disabled");
	} 
	else {
		$("#submitQuiz").hide();
		$("#prevQuestion").removeClass("disabled");
		$("#nextQuestion").removeClass("disabled");
	}
	
	// If question has already been answered
	// Load that answer
	var val = answersArray[question];
	console.log(val);
	if (val)
	{
		var selector = "#answerRadio"+val;
		$(selector).prop("checked", true);		
	}
}

function getNumQuestions() {
	$.ajax({
			type: 'GET',
			url: 'includes/get_num_questions.php',
			cache: false,
			success: function(result) {
				numQuestions = result;
			}
	});
}

function getCheckedValue()
{
	return $('form input[type=radio]:checked').val();
}