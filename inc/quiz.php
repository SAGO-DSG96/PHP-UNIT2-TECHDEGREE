<?php
/*
    @Author:Daniel Salazar
*/

// Make a variable to determine if the score will be shown or not. Set it to false.
$show_score = false;
// Start the session
session_start();
// Include questions from the questions.php file
include('questions.php');
// Include('questions.php');
include('generate_questions.php');
// Set how many question do you want to ask.
setLimit(10);

// If it does not exist $_SESSION["Questions"], this SESSION will have actual questions to ask
if(!isset($_SESSION["Questions"])) {
    // Create it as an array
    $_SESSION["Questions"] = [];
    // Call generateRandomQuestions() and save it
    $questions = generateRandomQuestions();
    // Assign each generate questions in a $_SESSION["Questions"] 
    foreach($questions as $question) {
        $_SESSION["Questions"][] = $question;
    }
}

// Variable to hold the total number of questions to ask.
$totalQuestions = count($_SESSION["Questions"]);

// Variable to hold the toast message.
$toast = null;

// If the server request was of type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user's answer was equal to the correct answer.
    if ($_POST['answer'] == $_SESSION["Questions"][$_POST['index']]['correctAnswer']) {
        // Assign a congratulutory string to the toast variable
        $toast = 'Well done! That’s correct.';
        // Increment the session variable that holds the total number correct by one.
        $_SESSION['totalCorrect'] = $_SESSION['totalCorrect'] + 1;
    }
    // Otherwise
    else{
         // Assign a bummer message to the toast variable.
        $toast = 'Bummer! That was incorrect.';
    }
    // Check if a session['used_indexes'] has ever been set/created to hold the indexes of questions already asked
    if (!isset($_SESSION['used_indexes'])) {
        // Create a session variable to hold used indexes and initialize it to an empty array
        $_SESSION['used_indexes'] = [];
        // Set the show score variable to false.
        $_SESSION['totalCorrect'] = 0;
    }
}


//If the number of used indexes in our session variable is equal to the total number of questions to be asked
if (count($_SESSION['used_indexes']) >= $totalQuestions) {
    //Reset the session variable for used indexes to an empty array 
    $_SESSION['used_indexes'] = [];
    $reset = 0;
    //Set the show score variable to true in order to show final message 
    $show_score = true;
    //Destroys the specified variable to force declare again and call generateRandomQuestions();
    unset($_SESSION["Questions"]);
}
else{
    //Set the show score variable to false in order to hide final message.
    $show_score = false;
    //If it is the first question of the round.
    if (count($_SESSION['used_indexes']) == 0) {
        //Session variable that holds the total correct to 0. 
        $_SESSION['totalCorrect'] = 0;
        //Toast variable to an empty string, do not show anything.
        $toast = null;
    }
    do {
         // Assign a random number to hold an index. Until you find a different number that has used in $_SESSION['used_indexes']
         $index = rand(0, count($_SESSION["Questions"]) - 1);
    } while (in_array($index, $_SESSION['used_indexes']));
   
    // Select a question that have not being asked.
    $question = $_SESSION["Questions"][$index];
    // Array_push of the $index to record that question have being asked
    array_push($_SESSION['used_indexes'], $index);
    // Variable with answers according to question
    $answers = array($question["firstIncorrectAnswer"],
                    $question["secondIncorrectAnswer"],
                    $question["correctAnswer"]);
    // Shuffle the $answers
    shuffle($answers);
}
//session_destroy(); 