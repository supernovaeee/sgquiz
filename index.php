<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singapore Quiz </title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $trimName = trim($name);
        if (empty($trimName) && !isset($_SESSION['name'])) {
            // display warning message if name is empty string
            $error = "Name cannot be blank";
            echo "<h4 style='color:red;'>$error</h4>";
        } else {
            // initialise session variables
            if (isset($_SESSION['name']) && !empty($trimName) && $_SESSION['name'] != $trimName) { // if the name is same, don't initialise a new overall score
                $_SESSION['overallScore'] = 0;
            }
            if (!isset($_SESSION['overallScore'])) // if overall score is not set, initialise a new overall score
                $_SESSION['overallScore'] = 0;
            if (!empty($trimName)) // if name exists (user has input their name, set session variable name to the existing name)
                $_SESSION['name'] = $trimName;
            $_SESSION['questionsGlobal'] = array();
            $_SESSION['questionHistory'] = array();
            $_SESSION['answerHistory'] = array();
            $_SESSION['modeHistory'] = array();
            $_SESSION['historyIndex'] = 0; // 0-based.
            $_SESSION['gameType'] = '';
            $_SESSION['randKeyArray'] = range(0, 19);
            // set historyAttempt and geoAttempt variables based on option input
            // direct to game.php after submitting
            if ($_POST['option'] == 'his') {
                $_SESSION['gameType'] = 'his';
                header('Location: game.php');
            } else {
                $_SESSION['gameType'] = 'geo';
                header('Location: game.php');
            }
            $name = $_SESSION['name'];
            $gameType = $_SESSION['gameType'];
            $txt = $name . "," . $gameType;
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
        }
    }
    ?>
    <div class="titleContainer">
        <h1>Singapore General Knowledge Quiz</h1>
    </div>
    <div class="pageContainer">
        <div class="column">
            <div class="head">
                <h1 class="title"> Enter your name to start — Pick the category — Click "Play"!</h1><br>
                <img class="logo"
                    src="https://cdn3.iconfinder.com/data/icons/world-landmark-vol-2/512/03-merlion-statue-landmark-singapore-512.png"
                    alt="alt">
            </div>
            <form action='index.php' method='POST'>
                <?php
                if (isset($_GET['userStatus']) && $_GET['userStatus'] == 'returning') {
                    echo '<h2>Welcome back, ' . $_SESSION['name'] . '!</h2>';
                } else {
                    echo '<div class="nameContainer">
                    <input class="name" type="text" name="name" placeholder="Your Name*" required>
                    </div>';
                }
                ?>
                <div class="radioContainer">
                    <div class="radioItem historyContainer">
                        <input type="radio" id="his" name="option" value="his" required>
                        <label for="his"> Singapore History</label><br>
                    </div>
                    <div class="radioItem geoContainer">
                        <input type="radio" id="geo" name="option" value="geo" required>
                        <label for="geo">Singapore Geography</label><br>
                    </div>
                </div>
                <div class="submitResetContainer">
                    <div class="submitResetItem resetContainer">
                        <button type='reset' name='reset' value='Reset'>Reset</button>
                    </div>
                    <div class="submitResetItem submitContainer">
                        <button type='submit' name='submit' value='Play'>Play!</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</body>

</html>