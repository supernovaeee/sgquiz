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
    // Display the number of correct and wrong answer
    $correct = countCorrect();
    $wrong = 5 - countCorrect();
    echo "<div class='correctWrongContainer'>Correct Answer: " . $correct . '<br>' . "Wrong Answer: " . $wrong . '<br></div>';
    function counter($correct, $wrong) // function to count score 
    
    {
        return $correct * 5 - $wrong * 3;
    }
    // Display points collected for current attempt and overall score (all attempts of the same user)
    $point = counter($correct, $wrong);
    $_SESSION['overallScore'] += $point;
    echo "<div class='correctWrongContainer'>Your Point: " . $point . '<br>' . '<br></div>';

    // Throw this first
    // . "Your Overall Score: " . $_SESSION['overallScore']
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
    <?php
    // NEW CODE: to write user overall scores in the database once they finish their attempt
    // bcs we assume that user session name def exists as the last data in the user db -> 
    // want to manipulate the last line of the user db -> array push 
    
    // 1. read the file into an array (line by line)
    // 2. take the last line
    // 3. modify the last line and add a new element (array push)
    // 4. check for condition -> overall score exists: overwrite! . overall score does not exist : add
    $file = "user.txt";
    if (
        // if file exists and is readable, 
        file_exists($file)
    ) {
        // .. open file
        $content = file($file, FILE_IGNORE_NEW_LINES); //Read the file into an array, skipping new lines
        $lastUser = end($content); // Take the last line of the array (String)
        $lastUserExploded = explode(",", $lastUser);
        $lastUserExploded[2] = $_SESSION['overallScore'] . "\n";
        $content[sizeof($content) - 1] = implode(",", $lastUserExploded); // Put the last line array back into string and store in the last element of content array
        $allContent = implode("\n", $content); //Put the array back into one string
        file_put_contents($file, $allContent); //Overwrite the file with the new content
    
    } else {
        // else, throw an error message
        die("unable to open file!");
    }
    ?>
</body>

</html>