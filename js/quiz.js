var questionsArray = [];
var competencyArray = [];
var answersArray = [];
var q = 0;

$(document).ready(function() {
	$("#quizContainer").hide();
	loadAllQuestions();
	
	$("#startButton").click(function() {
		$("#welcomeScreen").hide();
		$("#quizContainer").show();
		$("#submitQuiz").hide();
		$("#nextQuestion").removeClass("disabled");
		$("#prevQuestion").addClass("disabled");
		
		loadQuestion(q);
	});
	
	$("#prevQuestion").click(function() {
		if(q>0) {
			// Check if radio is marked
			if($('form input[type=radio]:checked').val()) {
				// Record answer to array
				answersArray[q] = getCheckedValue();
			}
			
			// Unmark all radio buttons
			$("input[name=answerRadio]").prop("checked", false);
			
			// Load previous question
			loadQuestion(--q);
			
			// Update the progress bar
			updateProgressBar();
			}			
	});
	
	$("#nextQuestion").click(function() {
		if(q<questionsArray.length) {
			if(!$('form input[type=radio]:checked').val()) {
				alert('Nothing is checked');
			} else {
				// Record answer to array
				answersArray[q] = getCheckedValue();
				
				// Unmark all radio buttons
				$("input[name=answerRadio]").prop("checked", false);
				
				// Load next question
				loadQuestion(++q);
				
				// Update the progress bar
				updateProgressBar();
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
			$("input[name='competencyValues']").val(JSON.stringify(competencyArray));
			$("form#quizForm").submit();
		}
	});
});

/**
 * Load all questions using the get_quiz_questions.php script
 * which returns an array of JSON objects. Each object has the
 * format of the Questions table, and so each object has a
 * Question key value pair. Load all of these Question values
 * into the questionsArray array. This is done once on document load
 * to make for faster loading of questions.
*/
function loadAllQuestions() {
	$.ajax({
			type: 'GET',
			url: 'includes/get_quiz_questions.php',
			cache: false,
			success: function(result) {
				var json = JSON.parse(result);
				for (var i = 0; i < json.length; i++)
				{
					questionsArray[i] = json[i].Question;
					competencyArray[i] = json[i].CompetencyID;
				}
				$("#numQuestions").html(questionsArray.length);
				$("#numQuestions").removeClass("fa");
				$("#numQuestions").removeClass("fa-spinner");
				$("#numQuestions").removeClass("fa-spin");
			}
	});
}

/**
 * Load the question from the questionsArray.
 * Check buttons are properly disabled/enabled
 * and update the progress bar.
 * @param {int} question - The question number to load
 */
function loadQuestion(question) {
	$("#question").html(questionsArray[question]);
	
	// Ensure proper buttons are shown/hidden
	// I.e. previous button not needed at the start
	// Toggled disabled
	if (question == 0) {
		$("#submitQuiz").hide();
		$("#nextQuestion").removeClass("disabled");
		$("#prevQuestion").addClass("disabled");
	}
	else if (question == questionsArray.length-1) {
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
	if (val)
	{
		var selector = "#answerRadio"+val;
		$(selector).prop("checked", true);		
	}
}

function updateProgressBar() {
	var progressValue = Math.floor(q / (questionsArray.length - 1) * 100);
	$(".progress-bar").attr('aria-valuenow', progressValue);
	$(".progress-bar").html(progressValue + "%");
	$(".progress-bar").css('width', progressValue + "%");
}

/**
 * Returns the index of the radio button checked.
 */
function getCheckedValue()
{
	return $('form input[type=radio]:checked').val();
}