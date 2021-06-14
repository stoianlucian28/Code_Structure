<?php 

include('../includePhp/path.php');
include(STANDARD_PATH .'\app\database\db.php');

if($_POST['practice_quiz_path']){

    $finished = $_POST['finished'];
    $quiz_path = $_POST['practice_quiz_path'];
    $score = $_POST['score'];
    $user_id = $_POST['user_id'];

    $sql = "UPDATE practice_quizes SET finished = '$finished' WHERE quiz_path = '$quiz_path' AND user_id = '$user_id'";
    $result =  mysqli_query($conn, $sql);
    $sql = "UPDATE user_score SET score = '$score' WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if($result){

        echo 'success';
    }

}
