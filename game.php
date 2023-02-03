<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="pageContainer game">
        <?php
        // ini_set('display_errors', 1);
        // error_reporting(E_ALL ^ E_NOTICE);
        session_start();
        // print_r($_SESSION['randKeyArray']);
        

        // variables to store session variables Live in previous question
        $_SESSION['correctAns'] = $_SESSION['correctAnsLive'];
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

        // Function to generate random key to later pick a question from text file
        function randomKey($gameType)
        {
            if ($gameType == 'history') {
                $n = sizeof($_SESSION['randKeyArray']) - 10; //subtract number of geog questions
                $randPointer = rand(0, $n - 1); // return any integer from 0-9 => question number 1-10
                $randKey = $_SESSION['randKeyArray'][$randPointer];
                array_splice($_SESSION['randKeyArray'], $randPointer, 1);
            } else {
                $n = sizeof($_SESSION['randKeyArray']) - 10; //subtract number of his questions
                $randPointer = rand(10, 9 + $n); // return any integer from 10-19 => question number 11-20
                $randKey = $_SESSION['randKeyArray'][$randPointer];
                array_splice($_SESSION['randKeyArray'], $randPointer, 1);
            }
            return $randKey; // question number = randKey + 1
        }
        function randomMode()
        {
            $rand = rand(0, 4);
            return $rand;
        }
        function parseQuestion($questionKey)
        {
            global $questions;
            $randLineArray = explode(",", $questions[$questionKey]);
            // Set session variables to store the randomly generated values into global variables
            $_SESSION['questionIDLive'] = $randLineArray[0];
            $_SESSION['questionLive'] = $randLineArray[2];
            $_SESSION['correctAnsLive'] = $randLineArray[3];
            $_SESSION['wrongAns1Live'] = $randLineArray[4];
            $_SESSION['wrongAns2Live'] = $randLineArray[5];
            $_SESSION['wrongAns3Live'] = $randLineArray[6];

        }
        if (isset($_POST['back'])) {
            $_SESSION['historyIndex']--;
            if ($_SESSION['historyIndex'] < 0) { // if user press backwards from the first question, go back to homepage and reset
                header('Location: index.php');
            } else { // if user press backwards from any question, will get the key from question history
                // get key for question and mode
                $key = $_SESSION['questionHistory'][$_SESSION['historyIndex']];
                $mode = $_SESSION['modeHistory'][$_SESSION['historyIndex']];
                // parse and display
                parseQuestion($key);
            }

        } else {
            if (isset($_POST['forward'])) {
                $_SESSION['historyIndex']++;
            }
            if ($_SESSION['historyIndex'] == sizeof($_SESSION['questionHistory'])) { // if the pointer is beyond the current array (user will attempt a new question), will randomise
                // get a random key for question and mode
                $randKey = randomKey($_SESSION['gameType']);
                $mode = randomMode();
                // parse and display
                parseQuestion($randKey);
                // Store the question history and the mode history
                array_push($_SESSION['questionHistory'], $randKey);
                array_push($_SESSION['modeHistory'], $mode);

            } else { // if the pointer is not beyond the current array (after backwards, user will go to question that is already attempted), will get the key from question history 
                // get key for question and mode
                $key = $_SESSION['questionHistory'][$_SESSION['historyIndex']];
                $mode = $_SESSION['modeHistory'][$_SESSION['historyIndex']];
                // parse and display
                parseQuestion($key);
            }
        }

        // Display header
        if ($_SESSION['gameType'] == 'history') {
            echo "<div class='gameTitleContainer'> <h1>This is History Game</h1></div>"; // display header for history game
        } else {
            echo "<div class='gameTitleContainer'> <h1>This is Geography Game</h1></div>"; // display header for geography game
        }

        // Display question
        echo "<div class='questionContainer'>" . ($_SESSION['questionLive']) . "</div>";
        // Display user's previous answer if he/she has already attempted.
        if (sizeof($_SESSION['answerHistory']) > $_SESSION['historyIndex']) {
            if ($mode == 0)
                echo '<label><br>Your previous answer was : ' . $_SESSION['answerHistory'][$_SESSION['historyIndex']] . '</label>';
            else {
                $rawRadioValue = $_SESSION['answerHistory'][$_SESSION['historyIndex']];
                $multipleChoice = explode(',', $rawRadioValue);
                echo '<label><br>Your previous answer was : ' . $multipleChoice[1] . '</label>';
            }
        }
        echo '<br>';
        echo '<br>';

        // Close questions file
        fclose($file);
        ?>
        <br><br>

        <label>Please select the correct answer</label><br>
        <form method="post" action="game.php">
            <?php
            // Display whether the answer is MCQ or short text input (based on randomise function result)
            if ($mode == 0) {
                echo '<div class="textAreaContainer"><input type="text" name="answer"></div>';
            } else {
                // 4 types of questions layout: correct Answer can be at 1st, 2nd, 3rd, or 4th position
                $layout1 = '<div class="radioContainer game">
            <input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive,A">
            <label for="correctAnsLive">' . "A. " . $_SESSION['correctAnsLive'] . ' </label><br>' . '<input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live,B">
            <label for="wrongAns1Live">' . "B. " . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live,C">
            <label for="wrongAns2Live">' . "C. " . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live,D">
            <label for="wrongAns3Live">' . "D. " . $_SESSION['wrongAns3Live'] . ' </label></div><br>';
                $layout2 = '<div class="radioContainer game"><input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live",A>
            <label for="wrongAns1Live">' . "A. " . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive,B">
            <label for="correctAnsLive">' . "B. " . $_SESSION['correctAnsLive'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live,C">
            <label for="wrongAns2Live">' . "C. " . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live,D">
            <label for="wrongAns3Live">' . "D. " . $_SESSION['wrongAns3Live'] . ' </label></div><br>';
                $layout3 = '<div class="radioContainer game"><input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live,A">
            <label for="wrongAns1Live">' . "A. " . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live,B">
            <label for="wrongAns2Live">' . "B. " . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive,C">
            <label for="correctAnsLive">' . "C. " . $_SESSION['correctAnsLive'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live,D">
            <label for="wrongAns3Live">' . "D. " . $_SESSION['wrongAns3Live'] . ' </label></div><br>';
                $layout4 = '<div class="radioContainer game"><input type="radio" id="wrongAns1Live" name="answer" value="wrongAns1Live,A">
            <label for="wrongAns1Live">' . "A. " . $_SESSION['wrongAns1Live'] . ' </label><br>' . '<input type="radio" id="wrongAns2Live" name="answer" value="wrongAns2Live,B">
            <label for="wrongAns2Live">' . "B. " . $_SESSION['wrongAns2Live'] . ' </label><br>' . '<input type="radio" id="wrongAns3Live" name="answer" value="wrongAns3Live,C">
            <label for="wrongAns3Live">' . "C. " . $_SESSION['wrongAns3Live'] . ' </label><br>' . '<input type="radio" id="correctAnsLive" name="answer" value="correctAnsLive,D">
            <label for="correctAnsLive">' . "D. " . $_SESSION['correctAnsLive'] . ' </label></div><br>';
                // Display the question layout (based on randomise function result)
                switch ($mode) {
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
                // $_SESSION['qnsAttempted'] += 1;
                $userAns = trim($_POST['answer']);
                if ($userAns != null && $userAns != '') {
                    $_SESSION['answerHistory'][$_SESSION['historyIndex'] - 1] = $userAns;
                }
                // if (sizeof($_SESSION['answerHistory']) == $_SESSION['historyIndex'] - 1) { // if foregoing page's answer has not been recorded
                //     array_push($_SESSION['answerHistory'], $userAns); // store userAns in the answerHistory array
                // } else  {
                // Compare userAns with correctAnsLive as string (MCQ) or with correctAns variable (short-answer qn)
                if ($userAns == $correctAns) {
                    $_SESSION['correct'] += 1;
                    array_push($_SESSION['correct_wrong_array'], "correct");
                } else {
                    $_SESSION['wrong'] += 1;
                    array_push($_SESSION['correct_wrong_array'], "wrong");

                }
                if ($_SESSION['qnsAttempted'] >= 5) {
                    header('Location: final.php');
                }
            }
            if (isset($_POST['back'])) {
                // $_SESSION['qnsAttempted'] -= 1;
                $userAns = trim($_POST['answer']);
                if ($userAns != null && $userAns != '') {
                    $_SESSION['answerHistory'][$_SESSION['historyIndex'] + 1] = $userAns;
                }
                // if (sizeof($_SESSION['answerHistory']) == $_SESSION['historyIndex'] + 1) { // if foregoing page's answer has not been recorded
                //     array_push($_SESSION['answerHistory'], $userAns);
                // } // at historyIndex + 1
            
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
            }
            // var_dump($_SESSION);
            echo "<br>";
            // print_r($_SESSION);
            
            ?>
            <div class="buttonContainer game">
                <button type='submit' name='back' value='Previous Question'>Previous Question</button>
                <button type='submit' name='forward' value='Next Question'>Next Question</button>
            </div>
        </form>
    </div>
</body>

</html>