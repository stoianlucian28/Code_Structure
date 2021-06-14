<?php

include(STANDARD_PATH .'\app\database\db.php');
include(STANDARD_PATH .'\app\helpers\validateLessonPage.php');

$table = 'lesson_pages';
$lessons = selectAll('lessons');
$lesson_pages = selectAll($table);

$errors = array();

$id = '';
$lesson_id = '';
$pg = '';
$last_page = '';
$paragraph = '';
$image_path = '';

function validateFiles($file, $path, $column)
{

    global $errors;

    if(!empty($file)){

        $file_name = time() . '_' . $file;
        $destination = STANDARD_PATH . $path . $file_name;
        $result = move_uploaded_file($_FILES[$column]['tmp_name'], $destination);

        if($result){

            $_POST[$column] = $file_name;
        }
        else{

            array_push($errors, "Failed to upload file");
        }
    }

}

if(isset($_POST['add-page'])){

    $errors = validateLessonPage($_POST);

    validateFiles($_FILES['image_path']['name'], "/assets/images_tmp/", 'image_path');
    validateFiles($_FILES['exercise_path']['name'], "/assets/exercises_tmp/", 'exercise_path');
    validateFiles($_FILES['test_path']['name'], "/assets/test_tmp/", 'test_path');
    validateFiles($_FILES['slider_path']['name'], "/assets/sliders_tmp/", 'slider_path');


    if(count($errors) == 0){
        
        unset($_POST['add-page']);

        if(isset($_POST['last_page'])){
            
            $_POST['last_page'] = 1;
           
        }
        else{

            $_POST['last_page'] = 0;
        }
    
        $page_id = create($table, $_POST);
        $_SESSION['message'] = 'Lesson page created successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/lesson-pages/index.php');
        exit();

    }
    else{

        $lesson_id = $_POST['lesson_id'];
        $pg = $_POST['pg'];
        $last_page = isset($_POST['last_page']) ? 1 : 0;
        $paragraph = $_POST['paragraph'];
    }

}

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $lesson_page = selectOne($table, ['id' => $id]);
    $id = $lesson_page['id'];
    $pg = $lesson_page['pg'];
    $last_page = isset($lesson_page['last_page']) ? 1 : 0;
    $paragraph = $lesson_page['paragraph'];
    $lesson_id = $lesson_page['lesson_id'];
}

if(isset($_GET['del_id'])){

    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Lesson page deleted successfully!';
    $_SESSION['type'] = 'alert-success';
    header('location: ' . BASE_URL . '/admin/lesson-pages/index.php');
    exit();
}

if(isset($_POST['update-page'])){

    $errors = validateLessonPage($_POST);

    validateFiles($_FILES['image_path']['name'], "/assets/images_tmp/", 'image_path');
    validateFiles($_FILES['exercise_path']['name'], "/assets/exercises_tmp/", 'exercise_path');
    validateFiles($_FILES['test_path']['name'], "/assets/test_tmp/", 'test_path');
    validateFiles($_FILES['slider_path']['name'], "/assets/sliders_tmp/", 'slider_path');

    if(count($errors) == 0){

        $id = $_POST['id'];
        unset($_POST['update-page'], $_POST['id']);
        $_POST['last_page'] = isset($_POST['last_page']) ? 1 : 0;
        $page_id = update($table, $id ,$_POST);
        $_SESSION['message'] = 'Lesson page updated successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/lesson-pages/index.php');
        exit();

    }
    else{

        $id = $_POST['id'];
        $lesson_id = $_POST['lesson_id'];
        $pg = $_POST['pg'];
        $last_page = isset($_POST['last_page']) ? 1 : 0;
        $paragraph = $_POST['paragraph'];
        $image_path = $_POST['image_path'];
    }

}

