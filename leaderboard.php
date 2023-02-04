<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    session_start();
    $file = "user.txt";
    if (
        // if file exists and is readable, 
        file_exists($file)
    ) {
        $content = file($file);
        $leaderboard = array();
        // Store only unique user data in leaderboard Array
        foreach ($content as $key => $val) {
            $explodedLine = explode(",", $val);
            $uniqueId = $explodedLine[0]; // same person 
            if (!isset($leaderboard[$uniqueId])) { // initialize if entry not made
                $leaderboard[$uniqueId] = 0;
            }
            $leaderboard[$uniqueId] += $explodedLine[2]; // add latest scores
        }
    } else {
        // else, throw an error message
        die("unable to open file!");
    }

    ?>
    <h1>Leaderboard</h1>
    <?php

    // Display leaderboard array
    if (isset($_POST['sortbyName'])) {
        ksort($leaderboard); // sort name in alphabetical order
    } else {
        arsort($leaderboard); // sort values from high to low (descending)
    }
    ?>
    <script> // JS Function to show pop-up message when user exits the game: containing user's name and overall score
        function showAlertAndRedirect() {
            var name = "<?php echo $_SESSION['name']; ?>";
            var overallScore = "<?php echo $_SESSION['overallScore']; ?>";
            // Show an alert message
            alert("Are you sure you want to exit, " + name + "?\nYour overall score is: " + overallScore);

            // Redirect the user to the desired page
            window.location.href = "index.php";
        }
    </script>


    <html>
    <!-- Prepare table structure and iterate through the leaderboard Array to display leaderboard. -->
    <div class="tableContainer">
        <table>
            <tr>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php foreach ($leaderboard as $key => $val) { ?>
                <div class=trContainer>
                    <tr>
                        <?php $explodedLine = explode(",", $key); ?>
                        <td>
                            <?php echo $explodedLine[0] ?>
                        </td>
                        <td>
                            <?php echo $val; ?>
                        </td>
                </div>
                </tr>
            <?php } ?>
        </table>
    </div>

    </html>

    <form method="post" action="leaderboard.php">
        <button type='submit' name='sortbyName' value='Sort by Name'>Sort by Name</button>
        <button type='submit' name='sortbyPoints' value='Sort by Points'>Sort by Points</button>
    </form>
    <div class="buttonContainer game">
        <form method="post" action="index.php?userStatus=returning">
            <div>
                <button type='submit' name='restart' value='Start A New Quiz'>Start A New Quiz</button>
            </div>
        </form>
        <button type='submit' onclick="showAlertAndRedirect()" name='exit' value='Exit the Game'>Exit
            the
            Game
        </button>
    </div>
</body>

</html>