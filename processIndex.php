<?php 
    // pre_r($_GET);
    if (isset($_POST['submit'])){ // form has been submitted
    echo "Hello ".$_POST['name'].'<br />';
    if ($_POST['option']=='his'){
        header('Location: history1.php');
    }
    else{
        header('Location: geo1.php');
    }
    }
?> 

<?php
    // function pre_r($array){
    //     echo '<pre>';
    //     print_r($array);
    //     echo '/<pre>';

    // }
?>