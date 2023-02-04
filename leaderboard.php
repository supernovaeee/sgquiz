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
            $uniqueId = $explodedLine[0] . "," . $explodedLine[1]; // same person same game type
            if (!isset($leaderboard[$uniqueId])) { // initialize if entry not made
                $leaderboard[$uniqueId] = 0;
            }
            $leaderboard[$uniqueId] += $explodedLine[2]; // add latest scores
        }

        // asort($leaderboard); // ascending value
        arsort($leaderboard); // descending value
        // ksort($leaderboard); // ascending keys 
        // krsort($leaderboard); // descending keys
    

        // Display leaderboard array
        foreach ($leaderboard as $key => $val) {
            $explodedLine = explode(",", $key);
            echo $explodedLine[0] . " " . $explodedLine[1] . " " . $val;
            echo "<br>";
        }


    } else {
        // else, throw an error message
        die("unable to open file!");
    }

    ?>
</body>

</html>