<?php 

include("includePhp/path.php");
include("app/controllers/users.php");

if(isset($_SESSION['id'])){
    header('location: ' . BASE_URL . '/courses.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>CodeStructure - Get Started!</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include("includePHP/head.php"); ?>
    
</head>
<body>

<?php include("includePHP/notlogged_nav.php"); ?>


<div class="pageContent">

  <div class="getStartedContent appearScene">

      <div class="container-fluid">
      
      <?php include("includePHP/messages.php"); ?>
        
          <div class="getStartedText">

            <img src="<?php echo BASE_URL . '/interactive/images/programmer.png';?>" alt="" class="img-fluid getStartedImage" width="600" height="600">

              <h1 class="getStartedTitle">
                  WELCOME TO <br> CODESTRUCTURE
              </h1>

              <h3 class="getStartedPromo">
                  Code Structure replaces conventional lectures <br>
                  with interactive lessons that are easy to learn. <br>
                  Learning through practice is a more efficient <br>
                  and fun way to learn.
              </h3>

              <a href="<?php echo BASE_URL . "/register.php";?>" id="get-started-signup" class="getStartedButton">Get started</a>    

          </div>

      </div>

    </div>

    <div class="separatorLine separator-1 appearScene">
        <div class="container-fluid"></div>
    </div>
    
    <div class="aboutCS-section appearScene">

        <div class="container-fluid">
            <div class="row">

                <div class="col">
                    <div class="aboutCSTitleSection">

                    <h1 class="aboutCSTitle">
                    Learn algorithms <br>
                    through <br> 
                    <span class="problem-solving-span">problem solving</span>
                    </h1>

                    <img src="<?php echo BASE_URL . '/interactive/images/problem_solving.png';?>" alt="" class="img-fluid aboutCS-image" width="300" height="300">

                    </div>
                </div>

                <div class="col">
                    <div class="aboutCSPromo promo-1">

                        <h3 class="aboutCSPromoTitle">

                            Data structures

                        </h3>

                        <h4 class="aboutCSPromoText">

                            Master the data structures fundamentals in a <br>
                            friendly environment, or if you already know <br>
                            the basics choose another level of progress.

                        </h4>

                    </div>

                    <div class="promo-separator-line">
                      <div class="container-fluid"></div>
                    </div>

                    <div class="aboutCSPromo promo-2">

                        <h3 class="aboutCSPromoTitle">

                            Algorithms

                        </h3>

                        <h4 class="aboutCSPromoText">

                            If you enjoy solving problems, then learning <br>
                            algortihms is the best way to improve your problem <br>
                            solving, in a challenging but still fun way.

                        </h4>

                    </div>

                    <div class="promo-separator-line">
                      <div class="container-fluid"></div>
                    </div>

                    <div class="aboutCSPromo promo-3">

                        <h3 class="aboutCSPromoTitle">

                            Learn easier, learn better

                        </h3>

                        <h4 class="aboutCSPromoText">

                            Code Structure's quest is to make learning of <br>
                            algorithms and data structures easier and more  <br>
                            practical.

                        </h4>

                    </div>

                </div>
                
            </div>

          </div>
    
    </div>

    <div class="separatorLine separator-2">
        <div class="container-fluid"></div>
    </div>

    <div class="aboutLessons">
    
        <div class="container-fluid">

            <div class="aboutLessonsContent"> 
            
                <div class="row justify-content-md-center padding-0">
                    
                    <div class="col">
                    
                        <div class="row justify-content-md-center">
                        
                            <div class="col-md-auto">
                                
                                <img src="<?php echo BASE_URL . "/interactive/images/algorithm_course_img.png"?>" alt="" class="img-fluid aboutLessonsContent-image" width="150" height="150"> 
                                
                            </div>   

                            <div class="col-md-auto">
                            
                                <h3 class="aboutLessonsContentTitle">
                                    Master, don't memorize
                                </h3>

                                <h4 class="aboutLessonsContentDescription">
                                    Instead of memorizing info without<br>
                                    hands on experience, Code Structure <br>
                                    offers interactive courses that teaches <br>
                                    algorithms and data structures from the <br>
                                    bottom up.
                                </h4>

                            </div> 
                        
                        </div>

                    </div>

                    <div class="col">
                    
                        <div class="row justify-content-md-center">
                        
                            <div class="col-md-auto">
                                
                                <img src="<?php echo BASE_URL . "/interactive/images/algorithm_course.png"?>" alt="" class="img-fluid aboutLessonsContent-image" width="150" height="150"> 
                                
                            </div>   

                            <div class="col-md-auto">
                            
                                <h3 class="aboutLessonsContentTitle">
                                    Learn the algorithms
                                </h3>

                                <h4 class="aboutLessonsContentDescription">
                                    Begin your journey in computer<br>
                                    science by learning the fundamentals <br>
                                    of algorithms like merge sort or bubble sort. <br>
                                    Algorithms are the base of every computer <br>
                                    operation.
                                </h4>

                            </div> 
                        
                        </div>

                    </div>

                    <div class="row justify-content-md-center padding-0">
                    
                    <div class="col">
                    
                        <div class="row justify-content-md-center">
                        
                            <div class="col-md-auto">
                                
                                <img src="<?php echo BASE_URL . "/interactive/images/ds_course_img.png"?>" alt="" class="img-fluid aboutLessonsContent-image" width="150" height="150"> 
                                
                            </div>   

                            <div class="col-md-auto">
                            
                                <h3 class="aboutLessonsContentTitle">
                                    Data Structures Course
                                </h3>

                                <h4 class="aboutLessonsContentDescription">
                                    Throughout this course you will learn<br>
                                    how to create and manipulate data <br>
                                    structures like a binary tree or a linked list. <br>
                                    Data structures are the base of a<br>
                                    computer storing data.
                                </h4>

                            </div> 
                        
                        </div>

                    </div>

                    <div class="col">
                    
                        <div class="row justify-content-md-center">
                        
                            <div class="col-md-auto">
                                
                                <img src="<?php echo BASE_URL . "/interactive/images/progress-icon.png"?>" alt="" class="img-fluid aboutLessonsContent-image" width="150" height="150"> 
                                
                            </div>   

                            <div class="col-md-auto">
                            
                                <h3 class="aboutLessonsContentTitle">
                                    Compete with others
                                </h3>

                                <h4 class="aboutLessonsContentDescription">
                                    Code Structure has a built in leaderboard<br>
                                    system. You can compete with others and <br>
                                    at the same time learn about algorithms and <br>
                                    data structures. You can get points by <br>
                                    completing  exercises, quizes and lessons.
                                </h4>

                            </div> 
                        
                        </div>

                    </div>
    
                </div>
            
            </div>
              
        </div>
    
    </div>

</div>

<div class="footerSpacing"></div>
 
<?php include("includePHP/footer.php"); ?>

<script type="text/javascript" src="script/mainPage_script.js"></script>
<script type="text/javascript" src="script/stickynav_script.js"></script>

</body>
</html>