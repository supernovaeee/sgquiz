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

    // $u_id = $_SESSION['u_id'];
    // $ans_id = $_SESSION['ans_id'];
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    

    // $currt_q = $_SESSION['currt_q'];
    // $q_1 = $_SESSION['q_1'];
    // $q_2 = $_SESSION['q_2'];
    // $q_3 = $_SESSION['q_3'];
    
    // $str_arr = explode("||", $q_1);
    // $q1_id = $str_arr[0];
    // $q1_name = $str_arr[2];
    // $q1_correct = $str_arr[3];
    // $q1_correctMark = $str_arr[4];
    // $q1_wrongMark = $str_arr[5];
    // $q1_ans1 = $str_arr[7];
    // $q1_ans2 = $str_arr[9];
    // $q1_ans3 = $str_arr[11];
    
    // $str_arr = explode("||", $q_2);
    // $q2_id = $str_arr[0];
    // $q2_name = $str_arr[2];
    // $q2_correct = $str_arr[3];
    // $q2_correctMark = $str_arr[4];
    // $q2_wrongMark = $str_arr[5];
    // $q2_ans1 = $str_arr[7];
    // $q2_ans2 = $str_arr[9];
    // $q2_ans3 = $str_arr[11];
    
    // $str_arr = explode("||", $q_3);
    // $q3_id = $str_arr[0];
    // $q3_name = $str_arr[2];
    // $q3_correct = $str_arr[3];
    // $q3_correctMark = $str_arr[4];
    // $q3_wrongMark = $str_arr[5];
    // $q3_ans1 = $str_arr[7];
    // $q3_ans2 = $str_arr[9];
    // $q3_ans3 = $str_arr[11];
    
    // $ans1 = 0;
    // $ans2 = 0;
    // $ans3 = 0;
    
    // if (isset($_POST['submit1'])) {
    //     $_SESSION['ans1'] = $_POST['ans1'];
    //     $_SESSION['currt_q'] = 2;
    // }
    // if (isset($_POST['submit2'])) {
    //     $_SESSION['ans2'] = $_POST['ans2'];
    //     $_SESSION['currt_q'] = 3;
    // }
    // if (isset($_POST['submit3'])) {
    //     $_SESSION['ans3'] = $_POST['ans3'];
    //     $_SESSION['currt_q'] = 4;
    //     $total_correct = 0;
    //     $total_score = 0;
    
    //     if ($q1_correct == $_SESSION['ans1']) {
    //         $total_correct = $total_correct + 1;
    //         $total_score = $total_score + $q1_correctMark;
    //     } else {
    //         $total_score = $total_score + $q1_wrongMark;
    //     }
    //     if ($q2_correct == $_SESSION['ans2']) {
    //         $total_correct = $total_correct + 1;
    //         $total_score = $total_score + $q2_correctMark;
    //     } else {
    //         $total_score = $total_score + $q2_wrongMark;
    //     }
    //     if ($q3_correct == $_SESSION['ans3']) {
    //         $total_correct = $total_correct + 1;
    //         $total_score = $total_score + $q3_correctMark;
    //     } else {
    //         $total_score = $total_score + $q3_wrongMark;
    //     }
    //     $total_wrong = 3 - $total_correct;
    
    //     $_SESSION['total_c'] = $total_correct;
    //     $_SESSION['total_wrong'] = $total_wrong;
    //     $_SESSION['total_score'] = $total_score;
    //     $data = $_SESSION['u_name'] . '||' . $_SESSION['qt_name'] . '||' . date('Y-m-d') . '||3||'
    //         . $_SESSION['total_c'] . '||' . $_SESSION['total_wrong'] . '||' . $_SESSION['total_score'];
    
    //     $write_results = fopen('db/results.txt', 'a');
    //     fwrite($write_results, $data . "\n");
    //     fclose($write_results);
    
    //     $file = fopen("db/results.txt", "r");
    //     $History = array();
    //     while (!feof($file)) {
    //         $History[] = fgets($file);
    //     }
    //     fclose($file);
    
    //     $ac = count($History);
    //     $currentGame = array();
    //     for ($x = 0; $x < $ac; $x++) {
    //         $str_arr = explode("||", $History[$x]);
    //         $p_name = $str_arr[0];
    //         if (trim($p_name) == trim($_SESSION['u_name'])) {
    //             array_push($currentGame, $History[$x]);
    //         }
    //     }
    // }
    
    ?>

    <p>This is the first question of Geography</p>
    <label>Please select the correct answer</label><br>
    <form method="post" action="game.php">
        <?php
        // $currt_q = $_SESSION['currt_q'];
        // if ($currt_q == 1) {
        //     echo '<br><h3>Q' . $currt_q . ') ' . $q1_name . '</h3>';
        //     echo '<input type="radio" name="ans1" value="1" required> &nbsp;' . $q1_ans1 . '<br><br>';
        //     echo '<input type="radio" name="ans1" value="2" required> &nbsp;' . $q1_ans2 . '<br><br>';
        //     echo '<input type="radio" name="ans1" value="3" required> &nbsp;' . $q1_ans3 . '<br><br>';
        //     echo '<button name="submit1">submit</button>';
        // }
        // if ($currt_q == 2) {
        //     echo '<br><h3>Q' . $currt_q . ') ' . $q2_name . '</h3>';
        //     echo '<input type="radio" name="ans2" value="1" required> &nbsp;' . $q2_ans1 . '<br><br>';
        //     echo '<input type="radio" name="ans2" value="2" required> &nbsp;' . $q2_ans2 . '<br><br>';
        //     echo '<input type="radio" name="ans2" value="3" required> &nbsp;' . $q2_ans3 . '<br><br>';
        //     echo '<button name="submit2">submit</button>';
        // }
        // if ($currt_q == 3) {
        //     echo '<br><h3>Q' . $currt_q . ') ' . $q3_name . '</h3>';
        //     echo '<input type="radio" name="ans3" value="1" required>&nbsp;' . $q3_ans1 . '<br><br>';
        //     echo '<input type="radio" name="ans3" value="2" required>&nbsp;' . $q3_ans2 . '<br><br>';
        //     echo '<input type="radio" name="ans3" value="3" required>&nbsp;' . $q3_ans3 . '<br><br>';
        //     echo '<button name="submit3">submit</button>';
        // }
        // if ($currt_q == 4) {
        //     echo '<h2>Quiz Taken: ' . $_SESSION['qt_name'] . '</h2>';
        //     echo '<h4>Results: </h4>';
        //     echo '<table>';
        //     echo '<tr><td>Total Questions&nbsp;&nbsp;&nbsp;&nbsp;</td><td>3</td></tr>';
        //     echo '<tr><td>Right Answers</td><td>' . $_SESSION['total_c'] . '</td></tr>';
        //     echo '<tr><td>Wrong Answers</td><td>' . $_SESSION['total_wrong'] . '</td></tr>';
        //     echo '<tr><td>Score</td><td>' . $_SESSION['total_score'] . '</td></tr>';
        //     echo '</table>';
        // }
        ?>
    </form>
</body>

</html>