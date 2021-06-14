<?php 

include("../includePhp/path.php");
include(STANDARD_PATH . "\app\controllers\courses_controller.php");

$chapters = selectAll('chapters');
$lessons = selectAll('lessons');
$lesson_pages = selectAll('lesson_pages');
if(isset($_GET['id'])){

    $course = selectOne('courses', ['id' => $_GET['id']]);
   
}

$users = selectAll('users');
if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
    $course_id = $course['id'];
    $user_id = $user['id'];
    $chapter_id_query = selectOne('chapters', ['course_id' => $course_id]);
    $chapter_id = $chapter_id_query['id'];

    $conditions = [

        'user_id' => $user_id
    ];
    $users_progress = selectAll('user_progress', $conditions);
    $courses_arr = array();
    $users_arr = array();

   
    foreach($users_progress as $progress){

        array_push($courses_arr, $progress['course_id']);
    }

    $isOk = false;

    if(in_array($course_id, $courses_arr)){

        $isOk = false;
    }
    else {

        $isOk = true;
    }

    if($isOk){

        mysqli_query($conn, "INSERT INTO user_progress (user_id, course_id) VALUES ($user_id, $course_id)");
    }

    $sql = "SELECT * FROM finished_lessons  WHERE user_id = $user_id AND course_id = $course_id ORDER BY id DESC LIMIT 1";
    $didUserStartCourseQuery = mysqli_query($conn, $sql);
    $didUserStartCourse = mysqli_fetch_assoc($didUserStartCourseQuery);

    $sql_2 = "SELECT * FROM lessons WHERE chapter_id = $chapter_id ORDER BY id ASC LIMIT 1";
    $firstLessonQuery = mysqli_query($conn, $sql_2);
    $firstLesson = mysqli_fetch_assoc($firstLessonQuery);

}


?>



<!DOCTYPE html>


<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeStructure - <?php echo $course['title']?></title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

<?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>


<div class="courses_content">
    
<input type="hidden" name="id"  value="<?php echo $id; ?>" >

    <div class="beginCourseSection">

        <div class="container-fluid">

            <div class="row">
                
                    <div class="col">

                        <h1 class="beginCourseSectionTitle">
                            <?php echo $course['title']?>
                        </h1>

                        <h3 class="beginCourseSectionSubTitle">
                        <?php echo $course['subtitle']?>
                        </h3>

                        <h5 class="beginCourseSectionText">

                        <?php
                        
                            $decription = $course['description'];
                            
                        ?>

                        <?php echo preg_replace('/\./', '.<br><br>', $decription);?>

                        </h5>

                    </div>


          
                

                <div class="col text-center">

                    <div class="card flex-row flex-wrap beginCourseSectionCard">

                            <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $course['image_path']; ?>" class="card-img-top img-fluid beginCourseSectionCard-image" alt="...">

                            <div class="card-body">
                                <h3 class="card-title">Begin your journey</h3>
                                <p class="card-text">
                                    Learn the concepts through interactive <br>
                                    courses and exercises.
                                </p>
                                <?php if(!empty($didUserStartCourse)):?>

                                    <a href="<?php echo BASE_URL . '/courses/lesson.php?lesson_id=' . $didUserStartCourse['lesson_id'] . '&pg=1'?>" class="btn btn-light card-btn">Continue Course</a>

                                <?php else:?>

                                    <a href="<?php echo BASE_URL . '/courses/lesson.php?lesson_id=' . $firstLesson['id'] . '&pg=1'?>" class="btn btn-light card-btn">Begin Course</a>

                                <?php endif;?>
                            </div>

                        </div>

                </div>

            </div>

        </div>

    </div>

    <div class="chapters">

        <div class="container-fluid">

        <!--///////////////////////////
                    !!CHAPTER!!
            //////////////////////////-->

            <?php foreach($chapters as $chapter):?>
            <?php if($chapter['course_id'] == $course['id']): ?>

            <div class="row">

                <h3 class="chapterTitle"><?php echo $chapter['title']?></h3>
                <h6 class="chapterSubTitle"><?php echo $chapter['subtitle']?></h6>

              

                <?php foreach($lessons as $lesson): ?>

                    <?php if($lesson['chapter_id'] == $chapter['id']): ?>

                        <div class="col-auto">

                            <div class="card chapterCard" style="width: 18rem; height: 330px;">
                                
                                <?php foreach($lesson_pages as $lesson_page):?>

                                    <?php if($lesson_page['lesson_id'] == $lesson['id']):?>

                                        <a href="/InteractiveWebsite/courses/lesson.php?lesson_id=<?php echo $lesson_page['lesson_id']?>&pg=1" class="chapter-card-link">

                                    <?php endif;?>

                                <?php endforeach;?>

                                    <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $lesson['image_path']; ?>" class="card-img-top img-fluid" alt="...">

                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $lesson['title']; ?></h4>
                                        <p class="card-text"><?php echo $lesson['subtitle']; ?></p>
                                    </div>

                                </a>

                            </div>

                        </div>

                    <?php endif;?>  

                <?php endforeach; ?>

                
               
                <?php if (isset($_SESSION['id'])): ?>

                    <?php if($_SESSION['admin']):?>
                        <div class="col-auto">

                            <div class="card addNewLesson" style="width: 18rem;">
                                
                                <a href="<?php echo BASE_URL . '/admin/lessons/index.php'?>" class="chapter-card-link">

                                    <div class="card-body">
                                        <h1 class="card-title text-center">+</h1>
                                    </div>

                                </a>

                            </div>
                        
                        </div> 
                    
                    <?php endif; ?>

                <?php endif; ?>
                
                

            </div>
             <?php endif; ?>           
            <?php endforeach;?>

    

            
        </div>
 
    </div>

</div>


<?php include(STANDARD_PATH . "/includePHP/footer.php"); ?>

<script type="text/javascript" src="<?php echo BASE_URL . '/script/stickynav_script.js';?>"></script>

</body>
</html>