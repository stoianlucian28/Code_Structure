<?php 

include('../includePhp/path.php');
include(STANDARD_PATH .'\app\database\db.php');

if($_POST['lesson_id']){

    $finished = $_POST['finished'];
    $lesson_id = $_POST['lesson_id'];
    $user_id = $_SESSION['id'];
    $sql = "UPDATE finished_lessons SET finished = '$finished' WHERE lesson_id = '$lesson_id' AND user_id = '$user_id'";
    $result =  mysqli_query($conn, $sql);

    if($result){

        echo 'success';
    }
}
