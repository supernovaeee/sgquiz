<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play</title>
</head>

<body>
    <?php
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    // variables to store session variables Live in previous question
    $_SESSION['question'] = $_SESSION['questionLive'];
    $_SESSION['questionID'] = $_SESSION['questionIDLive'];
    $_SESSION['correctAns'] = $_SESSION['correctAnsLive'];
    $_SESSION['wrongAns1'] = $_SESSION['wrongAns1Live'];
    $_SESSION['wrongAns2'] = $_SESSION['wrongAns2Live'];
    $_SESSION['wrongAns3'] = $_SESSION['wrongAns3Live'];
    print_r($_SESSION);
    ?>
    <?php
    // Open questions.txt file
    $file = fopen("questions.txt", "r");
    // Initialise array of questions
    $questions = array();
    // Tabulate $questions array by text in questions.txt
    while (!feof($file)) {
        $questions[] = fgets($file);
    }
    // Output a random question based on option input (History / Geography)
    // Split the random line taken from questions.txt by "," separator
    // to output only the question 
    if ($_SESSION['historyAttempt'] == 1) {
        $randKey = rand(0, 9);
        $randLineArray = explode(",", $questions[$randKey]);
        if (in_array($randLineArray[0], $_SESSION['used_questionID'])) {
            $randKey = rand(0, 9);
            $randLineArray = explode(",", $questions[$randKey]);
        }
        echo "<h2>This is History Game</h2>";
    } else {
        echo "<br>";
        $randKey = rand(10, 19);
        // echo "Random key generated:" . $randKey . "<br>";
        $randLineArray = explode(",", $questions[$randKey]);
        // If question is already used (exists in used_questionID), regenerate random question
        if (in_array($randLineArray[0], $_SESSION['used_questionID'])) {
            $randKey = rand(10, 19);
            $randLineArray = explode(",", $questions[$randKey]);
        }
        echo "<h2>This is Geography Game</h2>";

    }
    // Set session variables to store the randomly generated values into global variables
    $_SESSION['questionIDLive'] = $randLineArray[0];
    array_push($_SESSION['used_questionID'], $_SESSION['questionIDLive']);
    // 
    $_SESSION['questionLive'] = $randLineArray[2];
    $_SESSION['correctAnsLive'] = $randLineArray[3];
    $_SESSION['wrongAns1Live'] = $randLineArray[4];
    $_SESSION['wrongAns2Live'] = $randLineArray[5];
    $_SESSION['wrongAns3Live'] = $randLineArray[6];
    echo ($_SESSION['questionLive']);
    echo '<br>';
    echo '<br>';
    print_r($_SESSION['used_questionID']);
    // print_r($_SESSION['displayBundle']);
    

    // Close questions file
    fclose($file);
    ?>
    <br><br>

    <label>Please select the correct answer</label><br>
    <form method="post" action="game.php">
        <?php
        // Randomise whether the answer is MCQ or short text input
        $randKey = rand(0, 1);
        if ($randKey == 1) {
            echo '<input type="text" name="answer">';
        } else {
            // 4 types of questions layout: correct Answer can be at 1st, 2nd, 3rd, or 4th position
            $layout1 = '
            <input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive">
            <label for="correctAnsLive">' . $_SESSION['correctAnsLive'] . ' </label><br>' . '<input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live">
            <label for="wrongAns1Live">' . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live">
            <label for="wrongAns2Live">' . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live">
            <label for="wrongAns3Live">' . $_SESSION['wrongAns3Live'] . ' </label><br>';
            $layout2 = '<input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live">
            <label for="wrongAns1Live">' . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive">
            <label for="correctAnsLive">' . $_SESSION['correctAnsLive'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live">
            <label for="wrongAns2Live">' . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live">
            <label for="wrongAns3Live">' . $_SESSION['wrongAns3Live'] . ' </label><br>';
            $layout3 = '<input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live">
            <label for="wrongAns1Live">' . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live">
            <label for="wrongAns2Live">' . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive">
            <label for="correctAnsLive">' . $_SESSION['correctAnsLive'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live">
            <label for="wrongAns3Live">' . $_SESSION['wrongAns3Live'] . ' </label><br>';
            $layout4 = '<input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live">
            <label for="wrongAns1Live">' . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live">
            <label for="wrongAns2Live">' . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live">
            <label for="wrongAns3Live">' . $_SESSION['wrongAns3Live'] . ' </label><br>' . '<input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive">
            <label for="correctAnsLive">' . $_SESSION['correctAnsLive'] . ' </label><br>';
            // Randomise the question layout
            $randKey2 = rand(1, 4);
            switch ($randKey2) {
                case 1:
                    echo $layout1;
                    break;
                case 2:
                    echo $layout2;
                    break;
                case 3:
                    echo $layout3;
                    break;
                default:
                    echo $layout4;
            }
        }
        $correctAnsLive = trim($_SESSION['correctAnsLive']);
        $correctAns = trim($_SESSION['correctAns']);
        echo $correctAnsLive;
        echo "<br>";
        ?>
        <?php
        if (isset($_POST['forward'])) {
            $_SESSION['qnsAttempted'] += 1;
            $_SESSION['userAns'] = trim($_POST['answer']);
            $userAns = $_SESSION['userAns'];
            // Compare userAns with correctAnsLive as string (MCQ) or with correctAns variable (short-answer qn)
            if ($userAns == 'correctAnsLive' || $userAns == $correctAns) {
                echo "You are correct";
                echo "<br>";
                $_SESSION['correct'] += 1;
                array_push($_SESSION['correct_wrong_array'], "correct");
            } else {
                echo "You are wrong";
                echo "<br>";
                $_SESSION['wrong'] += 1;
                array_push($_SESSION['correct_wrong_array'], "wrong");

            }
            if ($_SESSION['qnsAttempted'] >= 5) {
                header('Location: final.php');
            }
        }
        if (isset($_POST['back'])) {
            $_SESSION['qnsAttempted'] -= 1;
            // Substract the point based on result of previously attempted question
            if (end($_SESSION['correct_wrong_array']) == "correct") {
                $_SESSION['correct'] -= 1;
                array_pop($_SESSION['correct_wrong_array']);
            } else if (end($_SESSION['correct_wrong_array']) == "wrong") {
                $_SESSION['wrong'] -= 1;
                array_pop($_SESSION['correct_wrong_array']);
            } else {
                echo "Fail to reset score from previous attempt!";
            }
            // Redirect to home page if pressing back from the first question page
            if ($_SESSION['qnsAttempted'] < 0) {
                header('Location: index.php');
            }

            // Display the previous question
            $prevQnID = end($_SESSION['used_questionID']);
            echo "Previous Question ID:" . $prevQnID;

            $_SESSION['questionIDLive'] = $_SESSION['questionID'];
            // array_push($_SESSION['used_questionID'], $_SESSION['questionIDLive']);
            // 
            $_SESSION['questionLive'] = $_SESSION['question'];
            $_SESSION['correctAnsLive'] = $_SESSION['correctAns'];
            $_SESSION['wrongAns1Live'] = $_SESSION['wrongAns1'];
            $_SESSION['wrongAns2Live'] = $_SESSION['wrongAns2'];
            $_SESSION['wrongAns3Live'] = $_SESSION['wrongAns3'];
        }
        // var_dump($_SESSION);
        echo "<br>";
        print_r($_SESSION);

        ?>
        <input type='submit' name='back' value='Previous Question' />
        <input type='submit' name='forward' value='Next Question' />
    </form>
</body>

</html>