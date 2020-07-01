<?php

/*
    @Author:Daniel Salazar
*/

//Modify for more questions
$limitQuestions = 0;

function setLimit($newVal){
    global $limitQuestions;
    $limitQuestions = $newVal;
}

// Generate random questions -> 10 in order to reuse our code in quiz.php
function generateRandomQuestions(){
    global $limitQuestions;
    // Array for new random questions
    $randomQuestions = [];
    // Loop to repeat and save in $randomQuestions array
    for ($i=0; $i < $limitQuestions; $i++) { 
        //do while to avoid repeat question in Adders.
        do {
            $leftAdder = rand(0,100);
            $rightAdder = rand(0,100);
        } while ($leftAdder == $rightAdder);
        //if it is not repeat save add in $correctAnswer
        // Calculate correct answer
        $correctAnswer = $leftAdder + $rightAdder;
        // Get incorrect answers within 10 numbers either way of correct answer
        do {
            $firstIncorrectAnswer = $correctAnswer + rand(-10,10);
            $secondIncorrectAnswer = $correctAnswer + rand(-10,10);
        } while (($firstIncorrectAnswer == $secondIncorrectAnswer) || ($firstIncorrectAnswer == $correctAnswer) 
                    ||  ($secondIncorrectAnswer== $correctAnswer));
        // Add question and answer to questions array
        $randomQuestions[] = [
            "leftAdder" => $leftAdder,
            "rightAdder" => $rightAdder,
            "correctAnswer" => $correctAnswer,
            "firstIncorrectAnswer" => $firstIncorrectAnswer,
            "secondIncorrectAnswer" => $secondIncorrectAnswer,
        ];
    }
    return $randomQuestions;
}