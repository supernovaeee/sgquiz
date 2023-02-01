<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singapore Quiz </title>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    session_unset();
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $trimName = trim($name);
        if (empty($trimName)) {
            // display warning message if name is empty string
            $error = "Name cannot be blank";
            echo "<h4 style='color:red;'>$error</h4>";
        } else {
            // initialise session variables
            $_SESSION['overallScore'] = 0;
            $_SESSION['name'] = $trimName;
            $_SESSION['historyAttempt'] = 0;
            $_SESSION['geoAttempt'] = 0;
            $_SESSION['wrong'] = 0;
            $_SESSION['correct'] = 0;
            $_SESSION['attempted'] = "";
            // set historyAttempt and geoAttempt variables based on option input
            // direct to game.php after submitting
            if ($_POST['option'] == 'his') {
                $_SESSION['historyAttempt'] = 1;
                header('Location: game.php');
            } else {
                $_SESSION['geoAttempt'] = 1;
                header('Location: game.php');
            }
            $name = $_SESSION['name'];
            $historyAttempt = $_SESSION['historyAttempt'];
            $geoAttempt = $_SESSION['geoAttempt'];
            $txt = $name . "," . $historyAttempt . ","
                . $geoAttempt;
            if (
                // if file exists and is readable, 
                file_exists("user.txt") &&
                ($handle = fopen("user.txt", "r")) == TRUE
            ) {
                // .. open file
                // write the name into the text file, line by line
                $myfile = fopen("user.txt", "a");
                fwrite($myfile, $txt . PHP_EOL);
            } else {
                // else, throw an error message
                die("unable to open file!");
            }
            fclose($myfile);
            if ($_POST['option'] == 'his') {
                header('Location: game.php');
            } else {
                header('Location: game.php');
            }
        }
    }
    ?>
    <form action='index.php' method='POST'>
        <div>
            <h1>Singapore General Knowledge Quiz</h1>
        </div>
        <div class="name-container">
            <input type="text" name="name" placeholder="Your Name*" required>
        </div>
        <div class="radio-container">
            <div class="history-container">
                <input type="radio" id="his" name="option" value="his" required>
                <label for="his"> Singapore History</label><br>
            </div>
            <div class="geo-container">
                <input type="radio" id="geo" name="option" value="geo" required>
                <label for="geo">Singapore Geography</label><br>
            </div>
        </div>
        <div class="submit-container">
            <input type='submit' name='submit' value='Enter the Game!' />
        </div>
        <div class="reset-container">
            <input type='reset' name='reset' value='Reset' />
        </div>
    </form>

</body>

</html>