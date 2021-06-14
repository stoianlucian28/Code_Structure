<?php

include("../includePhp/path.php");;
include(STANDARD_PATH . "/app/controllers/users.php");
include(STANDARD_PATH . "/app/controllers/users_progress.php");
include(STANDARD_PATH . "/app/permissions.php");
usersOnly();

$users = selectAll('users');

if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
   
}

$courses = selectAll('courses');


include(STANDARD_PATH . "/app/userScore.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CodeStructure - Progress</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

    <?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>

    
    <div class="progress-container">

        <div class="container-fluid">

            <div class="progress-content">

                <div class="progress-header">

                    <h3 class="progress-header-text">Progress</h3>
                    <div class="progress-delimiter"></div>

                </div>

                <div class="progress-block progress-info">

                    <div class="row">
                    
                        <div class="col progress-col">
                            
                            <i class="fas fa-star progress-icon"></i>
                            <div class="progress-info-container">

                                <h5 class="progress-text">Your overall score</h5>
                                <h5 class="variable"><?php echo $user_score['score'];?></h5>

                            </div>
                            
                        </div>

                        <div class="col progress-col">

                            <i class="fas fa-question progress-icon"></i>
                            <div class="progress-info-container">
                                <h5 class="progress-text">Quizes</h5>
                                <h5 class="variable"><?php echo $finished_quizes; ?></h5>
                            </div>
                        
                        </div>

                        <div class="col progress-col">

                            <i class="fas fa-file-alt progress-icon"></i>
                            <div class="progress-info-container">
                                <h5 class="progress-text">Exercises</h5>
                                <h5 class="variable"><?php echo $finished_exercises; ?></h5>
                            </div>
                        
                        </div>
                    
                    </div>

                </div>

            </div>

            <div class="courses-content">

                <div class="courses-header">

                    <h3 class="courses-header-text">Courses</h3>
                    <div class="progress-delimiter"></div>

                </div>

                <div class="progress-block courses-info">

                    <div class="row courses-info-row">
                        <?php foreach($users_progress as $progress):?>
                            <?php foreach($courses as $course):?>
                
                                <?php if($progress['course_id'] == $course['id'] && $user['id'] == $progress['user_id']):?>

                                <?php   
                                    $lessons_count = 0;
                                    $chapters = selectAll('chapters', ['course_id' => $course['id']]);
                                    foreach($chapters as $chapter){
                                        $all_lessons = selectAll('lessons', ['chapter_id' => $chapter['id']]);
                                        $lessons_count +=  count($all_lessons);
                                    }   
                                    
                                    $completed_lessons = selectAll('finished_lessons', ['user_id' => $user['id'], 'course_id' => $course['id'], 'finished' => '1']);
                                    
                                ?>
                                <a href="<?php echo BASE_URL . '/courses/course_page.php?id=' . $course['id']?>" class="progress-link-to-course">
                                <div class="courses-info-row-content">
                                    
                                    <div class="row">

                                        <div class="col-auto">

                                            <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $course['image_path'];?>" alt="" class="img-fluid quiz-img" width="100" height="100">

                                        </div>

                                        <div class="col">

                                            <div class="courses-info-container">

                                                <h5 class="course-title">

                                                    <?php echo $course['title']; ?>

                                                </h5>

                                                <div class="progress" style="width: 50%; border-radius: 0px;">
                                                    <div class="progress-bar profile-progress-bar" role="progressbar" 
                                                    <?php if(count($completed_lessons) != 0):?> style="<?php echo 'width: ' . $lessons_percentage = (count($completed_lessons) / $lessons_count) * 100 . '%';?>" <?php else:?> style="<?php echo 'width: 1%';?>" <?php endif;?>
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                </a>
                                <?php endif;?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    </div>

                </div>
                
            </div>

        </div>

    </div>

    <?php include(STANDARD_PATH . "/includePHP/footer.php"); ?>

</body>

</html>