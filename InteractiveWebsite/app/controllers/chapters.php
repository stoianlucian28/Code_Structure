<?php

include(STANDARD_PATH .'\app\database\db.php');
include(STANDARD_PATH .'\app\helpers\validateChapter.php');

$table = 'chapters';

$courses = selectAll('courses');
$chapters = selectAll($table);

$id = "";
$title = "";
$subtitle = "";
$course_id = "";

$errors = array();

if(isset($_GET['id'])){

    $chapter = selectOne($table, ['id' => $_GET['id']]);

    $id = $chapter['id'];
    $title = $chapter['title'];
    $subtitle = $chapter['subtitle'];
    $course_id = $chapter['course_id'];
}

if(isset($_GET['del_id'])){

    $count = delete($table, $_GET['del_id']);
    $_SESSION['message'] = 'Chapter deleted successfully';
    $_SESSION['type'] = 'alert-success';
    header("location: " . BASE_URL . "/admin/chapters/index.php");
    exit();
}

if(isset($_POST['add-chapter'])){
 
    $errors = validateChapter($_POST);

    if(count($errors) == 0){

        unset($_POST['add-chapter']);
        $_POST['user_id'] = $_SESSION['id'];
    
    
        $chapter_id = create($table, $_POST);
        $_SESSION['message'] = 'Chapter created successfully';
        $_SESSION['type'] = 'alert-success';
        header("location: " . BASE_URL . "/admin/chapters/index.php");
        exit();
    }
    else{

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $course_id = $_POST['course_id'];
    }
   
}

if(isset($_POST['update-chapter'])){

    $errors = validateChapter($_POST);

    if(count($errors) == 0){
        $id = $_POST['id'];
        unset($_POST['update-chapter'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
    
        $chapter_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Chapter updated successfully';
        $_SESSION['type'] = 'alert-success';
        header("location: " . BASE_URL . "/admin/chapters/index.php");
        exit();
    }
    else{

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $course_id = $_POST['course_id'];
    }
}


