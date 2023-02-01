<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    var_dump($_SESSION);
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
        echo "<h2>This is History Game</h2>";
        echo ($randLineArray[2]);
    } else {
        $randKey = rand(10, 19);
        $randLineArray = explode(",", $questions[$randKey]);
        echo "<h2>This is Geography Game</h2>";
        echo ($randLineArray[2]);
    }
    // Set session variables to store the randomly generated values into global variables
    $_SESSION['$question_ID'] = $randLineArray[0];
    $_SESSION['question'] = $randLineArray[2];
    $_SESSION['$correctAns'] = $randLineArray[3];
    $_SESSION['$wrongAns1'] = $randLineArray[4];
    $_SESSION['$wrongAns2'] = $randLineArray[5];
    $_SESSION['$wrongAns3'] = $randLineArray[6];
    // Close questions file
    fclose($file);
    ?>
    <?php
    // if (isset($_POST['back'])) {
    //     header('Location: history5.php');
    // }
    // if (isset($_POST['back'])) {
    //     header('Location: history3.php');
    // }
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
            <input type="radio" id="correctAns" name="answer" value="correctAns">
            <label for="correctAns">' . $_SESSION['$correctAns'] . ' </label><br>' . '<input type="radio" id="wrongAns1" name="answer" value="wrongAns1">
            <label for="wrongAns1">' . $_SESSION['$wrongAns1'] . ' </label><br>' . '<input type="radio" id="wrongAns2" name="answer" value="wrongAns2">
            <label for="wrongAns2">' . $_SESSION['$wrongAns2'] . ' </label><br>' . '<input type="radio" id="wrongAns3" name="answer" value="wrongAns3">
            <label for="wrongAns3">' . $_SESSION['$wrongAns3'] . ' </label><br>';
            $layout2 = '<input type="radio" id="wrongAns1" name="answer" value="wrongAns1">
            <label for="wrongAns1">' . $_SESSION['$wrongAns1'] . ' </label><br>' . '<input type="radio" id="correctAns" name="answer" value="correctAns">
            <label for="correctAns">' . $_SESSION['$correctAns'] . ' </label><br>' . '<input type="radio" id="wrongAns2" name="answer" value="wrongAns2">
            <label for="wrongAns2">' . $_SESSION['$wrongAns2'] . ' </label><br>' . '<input type="radio" id="wrongAns3" name="answer" value="wrongAns3">
            <label for="wrongAns3">' . $_SESSION['$wrongAns3'] . ' </label><br>';
            $layout3 = '<input type="radio" id="wrongAns1" name="answer" value="wrongAns1">
            <label for="wrongAns1">' . $_SESSION['$wrongAns1'] . ' </label><br>' . '<input type="radio" id="wrongAns2" name="answer" value="wrongAns2">
            <label for="wrongAns2">' . $_SESSION['$wrongAns2'] . ' </label><br>' . '<input type="radio" id="correctAns" name="answer" value="correctAns">
            <label for="correctAns">' . $_SESSION['$correctAns'] . ' </label><br>' . '<input type="radio" id="wrongAns3" name="answer" value="wrongAns3">
            <label for="wrongAns3">' . $_SESSION['$wrongAns3'] . ' </label><br>';
            $layout4 = '<input type="radio" id="wrongAns1" name="answer" value="wrongAns1">
            <label for="wrongAns1">' . $_SESSION['$wrongAns1'] . ' </label><br>' . '<input type="radio" id="wrongAns2" name="answer" value="wrongAns2">
            <label for="wrongAns2">' . $_SESSION['$wrongAns2'] . ' </label><br>' . '<input type="radio" id="wrongAns3" name="answer" value="wrongAns3">
            <label for="wrongAns3">' . $_SESSION['$wrongAns3'] . ' </label><br>' . '<input type="radio" id="correctAns" name="answer" value="correctAns">
            <label for="correctAns">' . $_SESSION['$correctAns'] . ' </label><br>';
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
        $correctAnsEssay = trim($_SESSION['$correctAns']);
        echo "Correct Ans from SESSION:" . $correctAnsEssay;
        echo "<br>";
        echo "Type: " . gettype($correctAnsEssay);
        echo "<br>";

        ?>
        <?php
        if (isset($_POST['forward'])) {
            $userAns = trim($_POST['answer']);
            echo "Your previous answer: " . $userAns;
            echo "<br>";
            echo "Type: " . gettype($userAns);
            echo "<br>";
            $userAnsEqualTocorrectAnsEssay = $userAns == $correctAnsEssay;
            echo "Is boolean?" . is_bool($userAnsEqualTocorrectAnsEssay);
            echo "<br>";
            echo "Is userAns equal to correctAnsEssay?";
            switch ($userAnsEqualTocorrectAnsEssay) {
                case true:
                    echo 'True';
                    break;
                case false:
                    echo 'False';
                    break;
                case null:
                    echo 'Null';
                    break;
                default:
                    echo 'Unknown';
            }
            echo "<br>";
            if ($userAns == 'correctAns' || $userAnsEqualTocorrectAnsEssay) {
                echo "You are correct";
                echo "<br>";
            } else {
                echo "You are wrong";
                echo "<br>";
            }
        }
        // var_dump($_SESSION);
        ?>
        <!-- <input type='submit' name='back' value='Previous Question' /> -->
        <input type='submit' name='forward' value='Next Question' />
    </form>
</body>

</html>