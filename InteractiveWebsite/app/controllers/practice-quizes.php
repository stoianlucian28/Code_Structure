<?php 

include(STANDARD_PATH .'\app\database\db.php');
include(STANDARD_PATH .'\app\helpers\validateQuiz.php');

$table = 'practice';
$courses = selectAll('courses');
$quizes = selectAll($table);

$errors = array();

$id = '';
$course_id = '';
$quiz_path = '';
$image_path = '';
$title = '';
$subtitle = '';

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

if(isset($_POST['add-quiz'])){

    $errors = validateQuiz($_POST);
    validateFiles($_FILES['quiz_path']['name'], "/assets/practice_tmp/", 'quiz_path');
    validateFiles($_FILES['image_path']['name'], "/assets/images_tmp/", 'image_path');

    if(count($errors) == 0){

        unset($_POST['add-quiz']);
        $quiz_id = create($table, $_POST);
        $_SESSION['message'] = 'Practice quiz added successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/practice-quizes/index.php');
        exit();
    }
    else{

        $course_id = $_POST['course_id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
    }

}

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $quiz = selectOne($table, ['id' => $id]);
    $id = $quiz['id'];
    $course_id = $quiz['course_id'];
    $title = $quiz['title'];
    $subtitle = $quiz['subtitle'];
}

if(isset($_GET['del_id'])){

    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Practice quiz deleted successfully!';
    $_SESSION['type'] = 'alert-success';
    header('location: ' . BASE_URL . '/admin/practice-quizes/index.php');
    exit();
}


if(isset($_POST['update-quiz'])){

    $errors = validateQuiz($_POST);

    validateFiles($_FILES['quiz_path']['name'], "/assets/practice_tmp/", 'quiz_path');
    validateFiles($_FILES['image_path']['name'], "/assets/images_tmp/", 'image_path');

    if(count($errors) == 0){

        $id = $_POST['id'];
        unset($_POST['update-quiz'], $_POST['id']);
        $quiz_id = update($table, $id ,$_POST);
        $_SESSION['message'] = 'Practice quiz updated successfully!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/practice-quizes/index.php');
        exit();
    }
    else{

        $id = $_POST['id'];
        $course_id = $_POST['course_id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
    }
}
