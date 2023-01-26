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
            header('Location: history3.php');
        }
    ?> 
    <p>This is the second question of History</p>
    <div class="next-container">
        <input type='submit' name='submit' value='Next Question' />
    </div>
</body>
</html>