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
    if ($_SESSION['historyAttempt'] == 1) {
        $randKey = rand(0, 9);
        echo $questions[$randKey];
        echo "<br>";
        echo "This is history question";
        echo "<br>";

    } else {
        $randKey = rand(10, 19);
        echo $questions[$randKey];
        echo "<br>";
        echo "This is geography question";
        echo "<br>";
    }
    // Close questions fiel
    fclose($file);
    ?>
    <label>Please select the correct answer</label><br>
    <form method="post" action="game.php">
        <?php
        ?>
    </form>
</body>

</html>