<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
</head>
<body>
    <style>
        body {
            background-color: #05467e;
            color: white;
            position: center;
            text-align: center;
        }

        .answers{
            padding-top: 40px;
        }
        
        .message-toast{
            padding-bottom: 20px;
        }

        .limiter{
            border-top: solid lightgrey;
            border-bottom: solid lightgrey;
            padding-bottom: 10px;
        }

        *{padding-top: 10px;}
    </style>

    <?php include('inc/quiz.php');?>
    <div class="container">
        <div id="quiz-box">
             <h1 class="animate__animated animate__bounce message-toast">
                <?php 
                //Block of code to print message of answers and continue asking questions until flag $show_score is true
                    if ($show_score == false) {

                        if ($toast != null) {
                            echo $toast;
                        }
                ?>
            </h1>
                            <p class="breadcrumbs limiter">Question <?php echo count($_SESSION['used_indexes']); ?> of <?php echo $totalQuestions; ?></p>
                            <p class="quiz">What is <?php echo $question['leftAdder']; ?> + <?php echo $question['rightAdder']; ?> ?</p>
                            <form action="index.php" method="post" class="answers">
                                <input type="hidden" name="index" value="<?php echo $index; ?>" />
                                <input type="submit" class="btn" name="answer" value="<?php echo $answers['0'] ?>" />
                                <input type="submit" class="btn" name="answer" value="<?php echo $answers['1'] ?>" />
                                <input type="submit" class="btn" name="answer" value="<?php echo $answers['2'] ?>" />
                            </form>
                <?php
                        }
                    else{
                        //Flag $show_score  true print end of quiz
                        echo '<h1>Yay, Well done!</h1>';
                        echo '<p class="limiter">You got ' . $_SESSION['totalCorrect'] .' of ' . $totalQuestions . ' correct!</p>'; ?>
                        <!-- Allow to reset QUIZ! - Added from:
                            https://stackoverflow.com/questions/16562577/how-can-i-make-a-button-redirect-my-page-to-another-page 
                            <button onclick="location.href = 'index.php';" id="myButton" class="btn" >Reset Quiz!</button> -->
                            <button onclick="location.href = 'index.php';" id="myButton" class="btn" >Reset Quiz!</button> 
                <?php   } ?>
        </div>
    </div>
</body>
</html>