<?php

include("includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/users.php");

$courses = selectAll('courses');
$quizes = selectAll('practice');

if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
   
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CodeStructure - Practice</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

    <?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>

     <div class="choose-quiz-section">
     
        <div class="container-fluid">
        
            <div class="practice-header">
            
                <h4 class="practice-title">
                
                Practice what you have learned

                </h4>

                <p class="practice-subtitle">
                Sharpen your skills with these quizzes designed to check your understanding of the fundamentals.
                </p>
            
            </div>

            <div class="practice-quizes-content">
                <?php foreach($courses as $key => $course):?>
                <div class="practice-choose-quiz-section">
                
                    <div class="left-content">

                        <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $course['image_path'];?>" alt="" class="img-fluid" width="100" height="100">
                        <h4 class="choose-quiz-section-title"><?php echo $course['title'];?></h4>

                    </div>
                    
                    <?php 
                         $key = $key + 1;  
                    ?>
                    <div class="right-content">

                        <i class="fas fa-angle-down list-quizes-button list-off" id="list-quizes-button-id-<?php echo $key;?>" onclick="toggleQuizList('list-quizes-button-id-<?php echo $key;?>', '#practice-quiz-container-id<?php echo $key;?>')"></i>

                    </div>

                    <div class="choose-quiz-line"></div>

                    
                    <?php foreach($quizes as $quiz):?>
                    <?php if($quiz['course_id'] == $course['id']):?>
                    <div class="practice-quiz-container">
                    
                        <div class="practice-quiz" id="practice-quiz-container-id<?php echo $key;?>" style="display:none">
                          
                            <div class="left-content">
                            
                                <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $quiz['image_path'];?>" alt="" class="img-fluid" width="100" height="100">
                                <h5 class="practice-quiz-section-title"><?php echo $quiz['title'];?></h5>
                                <p class="practice-quiz-description"><?php echo $quiz['subtitle'];?></p>

                            </div>

                            <div class="right-content">

                                <?php 
                                
                                    $finished_quiz = selectOne('practice_quizes', ['user_id' => $user['id'], 'practice_id' => $quiz['id'], 'quiz_path' => $quiz['quiz_path']]);

                                ?>                            
                                

                            <?php if(!empty($finished_quiz)):?>
                                <?php if($finished_quiz['finished'] == 1):?>
                                    <a href="<?php echo BASE_URL . '/practice/practice-quiz.php?id=' . $quiz['id'];?>" class="btn btn-light start-quiz-btn">Finished</a>
                                <?php else:?>
                                    <a href="<?php echo BASE_URL . '/practice/practice-quiz.php?id=' . $quiz['id'];?>" class="btn btn-light start-quiz-btn">Start</a>
                                <?php endif;?>
                            <?php else:?>
                                <a href="<?php echo BASE_URL . '/practice/practice-quiz.php?id=' . $quiz['id'];?>" class="btn btn-light start-quiz-btn">Start</a>
                            <?php endif;?>

                            </div>
                        
                        </div>
                    
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                
                </div>
            
                <?php endforeach;?>
            </div>

       

        </div>
     
     </div>

    <?php include(STANDARD_PATH . "/includePHP/footer.php"); ?>

    <script type="text/javascript" src="<?php echo BASE_URL . '/script/practice_script.js';?>"></script>
</body>

</html>