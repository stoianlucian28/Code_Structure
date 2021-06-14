<?php

include("../includePhp/path.php");
include(STANDARD_PATH . "/app/database/db.php");
include(STANDARD_PATH . "/app/permissions.php");
usersOnly();

if(isset($_GET['id'])){

    $p_quiz = selectOne('practice', ['id' => $_GET['id']]);
}


$users = selectAll('users');
if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
    $user_id = $user['id'];
    $practice_quiz_path = $p_quiz['quiz_path'];

    $user_conditions = [

        'user_id' => $user_id
    ];

    $practice_id = $p_quiz['id'];

    $isPracticeQuizOk = false;
    $practice_quizes = selectAll('practice_quizes', $user_conditions);
    $practice_quizes_arr = array();

    foreach($practice_quizes as $practice_quiz){
        
        array_push($practice_quizes_arr, $practice_quiz['quiz_path']);
    }

    if(in_array($practice_quiz_path, $practice_quizes_arr)){

        $isPracticeQuizOk = false;
    }
    else{

        $isPracticeQuizOk = true;
    }

    $addPracticeQuiz = [

        'user_id' => $user_id,
        'practice_id' => $practice_id,
        'quiz_path' => $practice_quiz_path
    ];

    if($isPracticeQuizOk && ($practice_quiz_path != null)){

        $p_quiz_id = create('practice_quizes', $addPracticeQuiz);
    }

    $user_score_id = selectOne('user_score', ['user_id' => $user_id]);
    $user_score = $user_score_id['score'];

    $finished_practice_quiz = selectOne('practice_quizes', ['quiz_path' => $practice_quiz_path, 'user_id' => $user_id]);
   
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Practice - <?php echo $p_quiz['title']?></title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

    <?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>

    <div class="quiz-container">

        <div class="container-fluid">

            <div class="quiz-container-header">

                <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $p_quiz['image_path'];?>" alt="" class="img-fluid quiz-header-img" width="200" height="200">
                <a href="<?php echo BASE_URL . '/practice.php';?>" class="back-to-practice-link">< Back</a>
                <h2 class="quiz-header-title"><?php echo $p_quiz['title']?></h2>

            </div>

            <div class="quiz-container-content">

                <?php include(STANDARD_PATH . "/assets/practice_tmp/" . $p_quiz['quiz_path']); ?>

            </div>

        </div>

    </div>

    <?php include(STANDARD_PATH . "/includePHP/footer.php"); ?>

</body>

</html>