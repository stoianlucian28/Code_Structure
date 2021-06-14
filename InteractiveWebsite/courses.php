<?php 
include("includePhp/path.php");
include("app/controllers/courses_controller.php");
include(STANDARD_PATH . "/app/controllers/users_progress.php");


$courses = selectAll('courses');

$users = selectAll('users');

if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
   
}

$lessons = selectAll('lessons');
$chapters = selectAll('chapters');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>CodeStructure - Courses</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include("includePHP/head.php"); ?>

</head>
<body>

<?php include("./includePHP/logged_nav.php"); ?>

<div class="coursesContent">

  <div class="mainCourses">

      <div class="container-fluid">

      <h1 class="mainCoursesTitle">Main courses</h1>
      <h4 class="mainCoursesText">These are the principal courses of the website</h4>

        <div class="row">
           
            <div class="col d-flex justify-content-center">
            <a href="<?php echo BASE_URL . '/courses/course_page.php?id=1';?>">
                <div class="mainCourseBox">

                    <h3 class="mainCourseBoxTitle">
                      Algorithms Course
                    </h3>

                    <h5 class="aboutMainCourse">
                        Start to think like a programmer. <br>
                        The algorithms courses will <br>
                        prepare you for the challenges that <br>
                        awaits every programmer. Algorithms are <br>
                        not only used to solve programming problems but <br>
                        also real life problems.
                    </h5>

                    <img src="<?php echo BASE_URL . '/interactive/images/algorithm_course_img.png';?>" alt="" class="img-fluid mainCourseBox-image" width="300" height="300">
                    
                </div>
            </a>
            </div>
          

            
            <div class="col d-flex justify-content-center">
            <a href="<?php echo BASE_URL . '/courses/course_page.php?id=2';?>">
                <div class="mainCourseBox">

                    <h3 class="mainCourseBoxTitle">
                      Data Structures Course
                    </h3>

                    <h5 class="aboutMainCourse">
                        Start to think like a programmer. <br>
                        The algorithms courses will <br>
                        prepare you for the challenges that <br>
                        awaits every programmer. Algorithms are <br>
                        not only used to solve programming problems but <br>
                        also real life problems.
                    </h5>

                    <img src="<?php echo BASE_URL . '/interactive/images/ds_course_img.png';?>" alt="" class="img-fluid mainCourseBox-image" width="300" height="300">
                    
                </div>
                </a>

            </div>

        </div>

      </div>

  </div>

  <div class="allCoursesContent">

      <div class="container-fluid">
          
          <h2 class="allCoursesTitle">Code Structure's courses</h2>

          <div class="row">

              <?php foreach($courses as $course):?>
                 
                <div class="col-auto d-flex justify-content-center">
                <form method="post" action="courses.php" id="submit-form-data-progress">
                    <a href="/InteractiveWebsite/courses/course_page.php?id=<?php echo $course['id']; ?>" name="access-course">
                        
                        <div class="allCoursesBox">

                            <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $course['image_path']?>" alt="" class="img-fluid allCoursesBox-image" width="200" height="200">

                            <h4 class="allCoursesBoxTitle">
                                <?php echo $course['title']?>
                            </h4>

                            <h6 class="allCoursesBoxText">
                                <?php echo $course['subtitle']?>
                            </h6>
                            
                        </div>

                    </a>

                </form>

                 </div>

              <?php endforeach; ?>
            
          </div>

      </div>

  </div>

  <div class="recentCourses">
      <div class="container-fluid">

            <h2 class="recentCoursesTitle">
              Recent courses
            </h2>
            <?php
                $lessons = array_slice($lessons, -5);
            ?>
            <?php foreach(array_reverse($lessons) as $lesson):?>
                

                <a href="<?php echo BASE_URL . '/courses/lesson.php?lesson_id=' . $lesson['id'] . '&pg=1';?>" class="courseCardLink">
                    
                    <div class="card flex-row flex-wrap recentCourses-card">
                        <div class="card-header border-0">
                            <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $lesson['image_path'];?>" alt="" class="img-fluid" width="350" height="350">
                        </div>
                        <div class="card-block px-2 cardInfo">

                            <?php foreach($chapters as $chapter):?>
                                <?php if($chapter['id'] == $lesson['chapter_id']):?>
                                    <h6 class="card-title recentCoursesCardCategory"><?php echo $chapter['title']?></h6>
                                <?php endif;?>
                            <?php endforeach;?>

                            <h3 class="card-title recentCoursesCardTitle "><?php echo $lesson['title'];?></h3>
                            <p class="card-text recentCoursesCardText">

                                <?php echo $lesson['subtitle'];?>

                            </p>
                            
                        </div>
                    
                    
                    </div>

                </a>
                
            <?php endforeach;?>
      </div>
  </div>

</div>

<?php include("includePHP/footer.php"); ?>

<script type="text/javascript" src="script/stickynav_script.js"></script>

<script>

function submitProgressData(){

    document.getElementById("submit-form-data-progress").submit();
}

</script>
</body>
</html>