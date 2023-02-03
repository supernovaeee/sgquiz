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
    // print_r($_SESSION['answerHistory']);
    function checker($x)
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
    function countCorrect()
    {
        $counter = 0;
        for ($x = 0; $x <= sizeof($_SESSION['answerHistory']); $x++) {
            $counter += checker($x);
        }
        return $counter;
    }

    $correct = countCorrect();
    $wrong = 5 - countCorrect();
    echo "Correct Answer: " . $correct;
    echo '<br>';
    echo "Wrong Answer: " . $wrong;
    echo '<br>';
    function counter($correct, $wrong)
    {
        return $correct * 5 - $wrong * 3;
    }
    $point = counter($correct, $wrong);
    // $_SESSION['overallScore'] += $point;
    echo "Your Point: " . $point;
    echo '<br>';
    // echo "Your Overall Score: " . $_SESSION['overallScore'];
    
    ?>
</body>

</html>