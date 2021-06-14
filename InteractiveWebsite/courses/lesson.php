<?php 

include("../includePhp/path.php");
include(STANDARD_PATH . "\app\controllers\lesson_pages.php");
include(STANDARD_PATH . "/app/permissions.php");
usersOnly();

$chapters = selectAll('chapters');
$lessons = selectAll('lessons');

$lesson_pages_arr = [

    'lesson_id' => $_GET['lesson_id']
];

$lesson_pages = selectAll('lesson_pages', $lesson_pages_arr);

$conditions = [
    'lesson_id' => $_GET['lesson_id'],
    'pg' => $_GET['pg']
];

if(isset($_GET['lesson_id'], $_GET['pg'])){

    $lesson_page = selectOne('lesson_pages', $conditions); 
    
}

$users = selectAll('users');
if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
    $page = $lesson_page['pg'];
    $lesson_id = $lesson_page['lesson_id'];
    $user_id = $user['id'];
    $chapter_id = '';
    $course_id = '';
    $exercise_path = $lesson_page['exercise_path'];
    $quiz_path = $lesson_page['test_path'];

    foreach($lessons as $lesson){

        if($lesson['id'] == $lesson_id){

            $chapter_id = $lesson['chapter_id'];
        }
    }

    foreach($chapters as $chapter){

        if($chapter['id'] == $chapter_id){

            $course_id = $chapter['course_id'];
        }
    }

    $user_conditions = [

        'user_id' => $user_id
    ];

    $finished_lessons = selectAll('finished_lessons', $user_conditions);
    $lessons_arr = array();

    foreach($finished_lessons as $lesson){

        array_push($lessons_arr, $lesson['lesson_id']);
    }

    $isOk = false;

    if(in_array($lesson_id, $lessons_arr)){

        $isOk = false;
    }
    else {

        $isOk = true;
    }

    if($isOk){

        mysqli_query($conn, "INSERT INTO finished_lessons (user_id, course_id, lesson_id) VALUES ($user_id, $course_id, $lesson_id)");
    }

    $exercises = selectAll('exercises', $user_conditions);
    $exercises_arr = array();

    foreach($exercises as $exercise){
        
        array_push($exercises_arr, $exercise['exercise_path']);
    }

    $isExOk = false;

    if(in_array($exercise_path, $exercises_arr)){

        $isExOk = false;
    }
    else{

        $isExOk = true;
    }

    $addExercise = [

        'user_id' => $user_id,
        'lesson_id' => $lesson_id,
        'page_id' => $page,
        'exercise_path' => $exercise_path

    ];

    if($isExOk && ($exercise_path != null)){

        $exercise_id = create('exercises', $addExercise);
    }

    foreach($exercises as $exercise){

        if($exercise['exercise_path'] == $lesson_page['exercise_path']){

            $finished_exercise = selectOne('exercises', ['lesson_id' => $lesson_id], ['page_id' => $page], ['user_id' => $user_id]);
        }
    }

    $isQuizOk = false;


    $quizes = selectAll('quizes', $user_conditions);
    $quizes_arr = array();

    foreach($quizes as $quiz){
        
        array_push($quizes_arr, $quiz['test_path']);
    }

    if(in_array($quiz_path, $quizes_arr)){

        $isQuizOk = false;
    }
    else{

        $isQuizOk = true;
    }

    $addQuiz = [

        'user_id' => $user_id,
        'lesson_id' => $lesson_id,
        'page_id' => $page,
        'test_path' => $quiz_path
    ];

    if($isQuizOk && ($quiz_path != null)){

        $quiz_id = create('quizes', $addQuiz);
    }

    $lesson = selectOne('lessons', ['id' => $lesson_id]);
    $chapter = selectOne('chapters', ['id' => $chapter_id]);

    $finished_ex = selectOne('exercises', ['user_id' => $user_id, 'exercise_path' => $exercise_path]);
    $finished_quiz = selectOne('quizes', ['user_id' => $user_id,'test_path' => $quiz_path]);

    //Getting all exercises from this lesson and check if they were all completed

    $all_exercises =  selectAll('exercises', ['user_id' => $user_id]);
    $completed_exercises = selectAll('exercises', ['user_id' => $user_id, 'finished' => '1']);
    $isAllExercisesCompleted = 0;

    if(count($all_exercises) == count($completed_exercises)){

        $isAllExercisesCompleted = 1;
    }

    //Getting all quizes from this lesson and check if they were all completed

    $all_quizes =  selectAll('quizes', ['user_id' => $user_id, 'lesson_id' => $lesson_id]);
    $completed_quizes = selectAll('quizes', ['user_id' => $user_id, 'lesson_id' => $lesson_id ,'finished' => '1']);
    $isAllQuizesCompleted = 0;

    if(count($all_quizes) == count($completed_quizes)){

        $isAllQuizesCompleted = 1;
    }

    $user_score_id = selectOne('user_score', ['user_id' => $user_id]);
    $user_score = $user_score_id['score'];
   
}



?>

<!-- $lesson_page = selectOne('lesson_pages', ['id' => $_GET['id']], ['pg' => $_GET['pg']]);  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lesson['title'];?></title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

<?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>

<div class="lessonContent">
<!--
//////////////////////////////////////////////////
                                            
                    PAGE                         
                                            
/////////////////////////////////////////////////
-->
    <div class="lesson-page" style="">

        <div class="container-fluid">

            <div class="row">
            
                <div class="col">
                
                    <div class="explanation-section">

                        <?php if($lesson_page['image_path'] != null):?>
                            <img src="<?php echo BASE_URL . '/assets/images_tmp/' . $lesson_page['image_path']; ?>" alt="" class="img-fluid lesson-page-img" width="750" height="450">
                        <?php endif;?>


                       <p class="explanationText paragraph-1">
                        
                       <?php echo preg_replace('/\./', '.<br><br>', $lesson_page['paragraph']);?>

                        </p>

                        <?php if($lesson_page['test_path'] != null):?>
                            <?php include(STANDARD_PATH . '/assets/test_tmp/' . $lesson_page['test_path']); ?>
                        <?php endif;?>

                        <?php if($lesson_page['exercise_path'] != null):?>
                            <?php include(STANDARD_PATH . '/assets/exercises_tmp/' . $lesson_page['exercise_path']); ?>
                        <?php endif;?>
                        
                        <?php if($lesson_page['slider_path'] != null):?>
                            <?php include(STANDARD_PATH . '/assets/sliders_tmp/' . $lesson_page['slider_path']); ?>
                        <?php endif;?>

                       

                    </div>

                </div>

                <div class="col text-center right-card">
                    
                    <div class="card control-area" style="width: 18rem;">
                        <div class="card-body">
                         
                            
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $chapter['title']; ?></h6>
                              

                            <h4 class="card-title"><?php echo $lesson['title'];?></h4>
                            
                            <nav class="lesson-pagination-container" aria-label="Page navigation">

                                <?php 
                                
                                    $count_pages = count($lesson_pages);
                          
                                ?>
                                <ul class="pagination lesson-pagination">
                                    <li class="page-item">
                                    <?php if($page != 1):?>
                                        <a class="page-link" href="<?php echo  BASE_URL . "/courses/lesson.php?lesson_id=" . $lesson_page['lesson_id'] . '&pg=' . $lesson_page['pg'] - 1 ;?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    <?php endif;?>
                                    </li>
                                    
                                    <?php foreach($lesson_pages as $lesson_page_next):?>

                                        <li class="page-item">

                                            <a class="page-link <?php if($page == $lesson_page_next['pg']):?> <?php echo 'selected-page';?> <?php endif;?>" href="<?php echo  BASE_URL . "/courses/lesson.php?lesson_id=" . $lesson_page_next['lesson_id'] . '&pg=' . $lesson_page_next['pg'];?>">
                                            <?php echo $lesson_page_next['pg'];?></a>

                                         </li>
                                       
                                    <?php endforeach;?>
                                        
                                    
                                    <li class="page-item">
                                        <?php if($lesson_page['last_page'] != 1):?>
                                            <a class="page-link" href="<?php echo  BASE_URL . "/courses/lesson.php?lesson_id=" . $lesson_page['lesson_id'] . '&pg=' . $lesson_page['pg'] + 1 ;?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        <?php endif;?>
                                    </li>
                                </ul>

                            </nav>
                            
                            <input type="hidden" id="lesson_id" value="<?php echo $lesson_id;?>">
                            <input type="hidden" id="finished" value="1">

                            <?php if($lesson_page['last_page'] == 1 && $isAllQuizesCompleted && $isAllExercisesCompleted):?>

                                <a class="btn btn-light finish-lesson-btn" href="<?php echo BASE_URL . "/courses/course_page.php?id=" . $course_id?>" onclick="finishLesson()">Finish Lesson</a>

                            <?php endif;?>

                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>

        </div>

    </div>

</div>



<?php include(STANDARD_PATH  . "/includePHP/footer.php"); ?>

<script type="text/javascript" src="<?php echo BASE_URL . '/script/stickynav_script.js';?>"></script>


<!--
///////////////////////////////////////////////////////////

             AJAX SCRIPT -> FINISH LESSON

//////////////////////////////////////////////////////////
-->

<script>

function finishLesson(){

    var lesson_id = $('#lesson_id').val();
    var finished = $('#finished').val();
    $.ajax({
        url: "<?php echo BASE_URL . '/app/postFinishedLesson.php';?>",
        method: "post",
        data: {lesson_id: lesson_id, finished: finished},
        success: function(){

            console.log('success');
        }
        
    });

}

</script>

</body>

</html>