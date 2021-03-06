// selfAssessment defined in quiz_page.php
var questionsArray = []; // array of objects
var completedIDs = [];
var q = 0;

$(document).ready(function() {
	$("#quizContainer").hide();
	loadAllQuestions();
	
	if(selfAssessment)
		$(".meOrThem").html("me")
	else
		$(".meOrThem").html("them");
	
	$("#startButton").click(function() {
		$("#welcomeScreen").hide();
		$("#quizContainer").show();
		$("#submitQuiz").hide();
		$("#nextQuestion").show();
		$("#prevQuestion").show();
		
		loadQuestion();
	});
	
	$("#prevQuestion").click(function() {
		if(q>0) {
			// Check if radio is marked
			if($('form input[type=radio]:checked').val()) {
				// Record answer to array
				recordCheckedValue();
			}
			
			// Unmark all radio buttons
			$("input[name=answerRadio]").prop("checked", false);
			
			// Load previous question
			q--;
			loadQuestion();
			
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
				recordCheckedValue();
				
				// Unmark all radio buttons
				$("input[name=answerRadio]").prop("checked", false);
				
				// Load next question
				q++;
				loadQuestion();
				
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
			// record the last answer
			recordCheckedValue();
			
			// update POST variables
			// and submit the quiz form
			$("input[name='answers']").val(JSON.stringify(questionsArray));
			$("form#quizForm").submit();
		}
	});
	
	$("#saveProgress").click(function() {
		if($('form input[type=radio]:checked').val()) {
			// record the last answer
			recordCheckedValue();
		}
		
		// update POST variables
		// and submit the quiz form
		$("input[name='answers']").val(JSON.stringify(questionsArray));
		$("form#quizForm").submit();
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
			url: 'ajax/get_quiz_questions.php',
			cache: false,
			success: function(result) {
				var json = JSON.parse(result);
				for (var i = 0; i < json.length; i++)
				{
					var questionID = parseInt(json[i].ID);
					
					if(quizResume.length == 0 || quizResume.indexOf(questionID) != -1)
					{
						questionObject = {};
						if(selfAssessment)
							questionObject.question = json[i].QuestionSelf;
						else
							questionObject.question = json[i].QuestionOther;
						
						// Save questions's ID so we can track progress
						questionObject.ID = questionID;
						
						questionObject.weight = parseInt(json[i].WeightValue);
						questionObject.competencyID = parseInt(json[i].CompetencyID);
						
						questionsArray.push(questionObject);
					}
				}
				if (questionsArray.length < json.length)
				{
					// Some questions were omitted. Quiz is resume
					console.log("resuming quiz...");
				}
				
				shuffleArray();
				$("#numQuestions").html(questionsArray.length);
				$("#numQuestions").removeClass("fa");
				$("#numQuestions").removeClass("fa-spinner");
				$("#numQuestions").removeClass("fa-spin");
			}
	});
}

function shuffleArray() {
  var currentIndex = questionsArray.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = questionsArray[currentIndex];
    questionsArray[currentIndex] = questionsArray[randomIndex];
    questionsArray[randomIndex] = temporaryValue;
  }
}

/**
 * Load the question from the questionsArray.
 * Check buttons are properly disabled/enabled
 * and update the progress bar.
 * @param {int} question - The question number to load
 */
function loadQuestion() {
	$("#question").html(questionsArray[q].question);
	
	// Ensure proper buttons are shown/hidden
	// I.e. previous button not needed at the start
	// Toggled disabled
	if (q == 0) {
		$("#submitQuiz").hide();
		$("#saveProgress").show();
		$("#nextQuestion").show();
		$("#prevQuestion").hide();
	}
	else if (q == questionsArray.length-1) {
		$("#submitQuiz").show();
		$("#saveProgress").hide();
		$("#nextQuestion").hide();
		$("#prevQuestion").show();
	} 
	else {
		$("#submitQuiz").hide();
		$("#saveProgress").show();
		$("#prevQuestion").show();
		$("#nextQuestion").show();
	}
	
	// If question has already been answered
	// Load that answer
	var val = questionsArray[q].answer;
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
function recordCheckedValue()
{
	var val = $('form input[type=radio]:checked').val();
	if (questionsArray[q].weight == -1)
	{
		val = 5 - val;
	}
	questionsArray[q].answer = val;
	console.log("q: "+q+" val: "+val);
}