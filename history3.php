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
        if (isset($_POST['submit'])){ 
            header('Location: history4.php');
        }
        if (isset($_POST['back'])){ 
            header('Location: history2.php');
        }
    ?> 
    <p>This is the third question of History</p>
    <div class="back-container">
        <form action='history3.php' method='POST'>
            <input type='submit' name='back' value='Previous Question' />
        </form>
    </div>
    <div class="next-container">
        <form action='history3.php' method='POST'>
            <input type='submit' name='submit' value='Next Question' />
        </form>
    </div>
</body>
</html>