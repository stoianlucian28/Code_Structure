<?php

include(STANDARD_PATH .'\app\database\db.php');
include(STANDARD_PATH .'\app\helpers\validateLesson.php');

$courses = selectAll('courses');
$chapters = selectAll('chapters');
$table = 'lessons';
$lessons = selectAll($table);

$errors = array();
$id = '';
$title = '';
$subtitle = '';
$chapter_id = '';

if(isset($_POST['add-lesson'])){

    $errors = validateLesson($_POST);

    if(!empty($_FILES['image_path']['name'])){

        $image_name = time() . '_' . $_FILES['image_path']['name'];
        $destination = STANDARD_PATH . "/assets/images_tmp/" . $image_name;

        $result = move_uploaded_file($_FILES['image_path']['tmp_name'], $destination);

        if($result){

            $_POST['image_path'] = $image_name;
        }
        else{

            array_push($errors, "Failed to upload image");
        }
    }
    else{

        array_push($errors, "You have to choose an image");
    }

    if(count($errors) == 0){

        unset($_POST['add-lesson']);
        $lesson_id = create($table, $_POST);
        $_SESSION['message'] = 'Lesson created successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/lessons/index.php');
        exit();
    }
    else{

        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $chapter_id = $_POST['chapter_id']; 
    }


}

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $lesson = selectOne($table, ['id' => $id]);
    $id = $lesson['id'];
    $title = $lesson['title'];
    $subtitle = $lesson['subtitle'];
    $chapter_id = $lesson['chapter_id'];
}

if(isset($_GET['del_id'])){

    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Lesson deleted successfully!';
    $_SESSION['type'] = 'alert-success';
    header('location: ' . BASE_URL . '/admin/lessons/index.php');
    exit();
}

if(isset($_POST['update-lesson'])){

    $errors = validateLesson($_POST);

    if(!empty($_FILES['image_path']['name'])){

        $image_name = time() . '_' . $_FILES['image_path']['name'];
        $destination = STANDARD_PATH . "/assets/images_tmp/" . $image_name;

        $result = move_uploaded_file($_FILES['image_path']['tmp_name'], $destination);

        if($result){

            $_POST['image_path'] = $image_name;
        }
        else{

            array_push($errors, "Failed to upload image");
        }
    }
    else{

        array_push($errors, "You have to choose an image");
    }

    if(count($errors) == 0){

        $id = $_POST['id'];
        unset($_POST['update-lesson'], $_POST['id']);
        $lesson_id = update($table, $id ,$_POST);
        $_SESSION['message'] = 'Lesson updated successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/lessons/index.php');
        exit();
    }
    else{

        $id = $_POST['id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $chapter_id = $_POST['chapter_id']; 
    }

}