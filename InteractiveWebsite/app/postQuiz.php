<?php 

include('../includePhp/path.php');
include(STANDARD_PATH .'\app\database\db.php');

if($_POST['quiz_path']){

    $finished = $_POST['finished'];
    $test_path = $_POST['quiz_path'];
    $score = $_POST['score'];
    $user_id = $_POST['user_id'];

    $sql = "UPDATE quizes SET finished = '$finished' WHERE test_path = '$test_path' AND user_id = '$user_id'";
    $result =  mysqli_query($conn, $sql);
    $sql = "UPDATE user_score SET score = '$score' WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if($result){

        echo 'success';
    }

}
