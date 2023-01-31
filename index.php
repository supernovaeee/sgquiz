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
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $trimName = trim($name);
        if (empty($trimName)){
            $error = "Name cannot be blank";
            echo "<h4 style='color:red;'>$error</h4>";
        } else {
            session_start();
            $_SESSION['overallScore'] = 0;
            $_SESSION['name'] = $trimName;
            $_SESSION['historyAttempt'] = 0;
            $_SESSION['geoAttempt'] = 0;
            $_SESSION['wrong'] = 0;
            $_SESSION['correct'] = 0;
            $_SESSION['attempted'] = "";
            if ($_POST['option']=='his'){
                header('Location: history1.php');
            }
            else{
                header('Location: geo1.php');
            }
        }
    }
?>
    <form action='index.php' method='POST'>
        <div><h1>Singapore General Knowledge Quiz</h1></div>
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