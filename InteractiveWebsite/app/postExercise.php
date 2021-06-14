<?php 

include('../includePhp/path.php');
include(STANDARD_PATH .'\app\database\db.php');

if($_POST['exercise_path']){

    $finished = $_POST['finished'];
    $exercise_path = $_POST['exercise_path'];
    $score = $_POST['score'];
    $user_id = $_POST['user_id'];

    $sql = "UPDATE exercises SET finished = '$finished' WHERE exercise_path = '$exercise_path' AND user_id = '$user_id'";
    $result =  mysqli_query($conn, $sql);
    $sql = "UPDATE user_score SET score = '$score' WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result){

        echo 'success';
    }
}
