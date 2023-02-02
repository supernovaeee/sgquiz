<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Your Result</h1>
    <?php
    session_start();
    $correct = $_SESSION['correct'];
    $wrong = $_SESSION['wrong'];
    echo "Correct Answer: " . $correct;
    echo '<br>';
    echo "Wrong Answer: " . $wrong;
    echo '<br>';
    function counter($correct, $wrong)
    {
        return $correct * 5 - $wrong * 3;
    }
    $point = counter($correct, $wrong);
    $_SESSION['overallScore'] += $point;
    echo "Your Point: " . $point;
    echo '<br>';
    echo "Your Overall Score: " . $_SESSION['overallScore'];

    ?>
</body>

</html>