<?php

include(STANDARD_PATH .'\app\helpers\validateCourse.php');
include(STANDARD_PATH . "\app\database\db.php");


$table = 'courses';
$courses = selectAll($table);

$errors = array();
$id = '';
$title = '';
$subtitle = '';
$description = '';

//Create a new course.

if(isset($_POST['add-course'])){

    //Validates the form.
    $errors = validateCourse($_POST);

    //Validates the selected image.
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
    //If the data validation is successful, then it creates a new row into the database.
    if(count($errors) == 0){

        unset($_POST['add-course']);
        $course_id = create($table, $_POST);
        $_SESSION['message'] = 'Course created successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/courses/index.php');
        exit();
    }
    else{

        $chapter_number = $_POST['chapter_number'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $description = $_POST['description'];
    }

}
    
//Getting the id of the course then fetches all data from the row that contains the selected id.

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $course = selectOne($table, ['id' => $id]);
    $id = $course['id'];
    $title = $course['title'];
    $subtitle = $course['subtitle'];
    $description = $course['description'];

}

if(isset($_GET['del_id'])){

    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Course deleted successfully!';
    $_SESSION['type'] = 'alert-success';
    header('location: ' . BASE_URL . '/admin/courses/index.php');
    exit();
}

//Update an existent course

if(isset($_POST['update-course'])){

    $errors = validateCourse($_POST);
  
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
        unset($_POST['update-course'], $_POST['id']);
        $course_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Course updated successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/courses/index.php');
        exit();
    }
    else{

        $id = $_POST['id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $description = $_POST['description'];
    }
}