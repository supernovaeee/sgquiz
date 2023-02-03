<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Your Result</h1>
    <?php
    session_start();
    function checker($x) // a function to check whether user answer matches with the answer database 
    
    {
        $LineArray = explode(",", $_SESSION['questionsGlobal'][$_SESSION['questionHistory'][$x]]);
        $correctStatement = explode(",", $_SESSION['answerHistory'][$x]);
        if ($_SESSION['modeHistory'][$x] == 0) {
            if ($_SESSION['answerHistory'][$x] == $LineArray[3]) {
                return 1;
            } else {
                return 0;
            }
        } else {
            if ($correctStatement[0] == "correctAnsLive") {
                return 1;
            } else {
                return 0;
            }
        }
    }
    function countCorrect() // a function to iterate through the user answer history array and count the number of correct answers
    
    {
        $counter = 0;
        for ($x = 0; $x <= sizeof($_SESSION['answerHistory']); $x++) {
            $counter += checker($x);
        }
        return $counter;
    }

    $correct = countCorrect();
    $wrong = 5 - countCorrect();
    echo "<div class='correctWrongContainer'>Correct Answer: " . $correct . '<br>' . "Wrong Answer: " . $wrong . '<br></div>';
    function counter($correct, $wrong) // function to count score 
    
    {
        return $correct * 5 - $wrong * 3;
    }
    $point = counter($correct, $wrong);
    $_SESSION['overallScore'] += $point;
    echo "<div class='correctWrongContainer'>Your Point: " . $point . '<br>' . "Your Overall Score: " . $_SESSION['overallScore'] . '<br></div>';
    ?>
    <div class="buttonContainer game">
        <form method="post" action="index.php?userStatus=returning">

            <button type='submit' name='restart' value='Start A New Quiz'>Start A New Quiz</button>
        </form>
        <form method="post" action="leaderboard.php">
            <button type='submit' name='leaderboard' value='View Leaderboard'>View Leaderboard</button>
        </form>
        <form method="post" action="index.php">
            <button type='submit' name='exit' value='Exit the Game'>Exit the Game</button>
        </form>
    </div>
</body>

</html>