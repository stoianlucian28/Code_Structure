<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/lesson_pages.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();

?>


<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Dashboard - Edit Page</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include("../../includePHP/head.php"); ?>

</head>
<body>
    
    
    <?php include("../../includePHP/dashboardHeader.php"); ?>
    <?php include("../../includePHP/dashboardBar.php"); ?>
    
    <div class="admin-content">

        <div class="content">

            <div class="container-fluid">

                <h2 class="admin-content-title">
                    Create lesson page
                </h2>

            

                <form action="edit.php" method="post" class="admin-form" enctype = "multipart/form-data">

                    <?php include("../../app/helpers/formErrors.php");?>

                    <div class="mb-3">
                        <input type="hidden" name="id"  value="<?php echo $id; ?>">
                    </div>

                    <div class="mb3">
                    
                        <label class="form-label">Select page number</label>

                        <input type="text" name="pg" value="<?php echo $pg;?>" class="form-control page-num">  

                    </div>

                      <div class="mb3">

                        <div class="form-check">

                            <?php if(isset($last_page) && $last_page == 1): ?>

                                <input class="form-check-input" type="checkbox" name="last_page"  id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Last page
                                </label>

                            <?php else: ?>

                                <input class="form-check-input" type="checkbox" name="last_page" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Last page
                                </label>

                            <?php endif; ?>

                        </div>
              
                    <div class="mb3">

                        <label for="" class="form-label">Select lesson</label>
                        <select class="form-select select-chapter" name="lesson_id"  aria-label="Default select example">

                            <option value=""></option>
                            
                            <?php foreach($lessons as $key => $lesson): ?>
                                
                                <?php if(!empty($lesson_id) && $lesson_id == $lesson['id']): ?>

                                    <option selected value="<?php echo $lesson['id'];?>"><?php echo $lesson['title']; ?></option>

                                <?php else: ?>

                                    <option value="<?php echo $lesson['id'];?>"><?php echo $lesson['title']; ?></option>

                                <?php endif;?>

                            <?php endforeach; ?>
                         
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="admin-paragraph-text" class="form-label">Paragraph text</label>
                        <textarea class="form-control" name="paragraph" id="admin-paragraph-text"><?php echo $paragraph;?></textarea>
                    </div>

                    
                    <div class="mb-3">

                         <div class="form-check form-switch">
                            <input onclick="toggleImage()" class="form-check-input" type="checkbox" id="switch-image" >
                            <label class="form-check-label" for="switch-iex">Add image</label>
                        </div>

                        <div class="mb-3" id="image-form">
                            <label for="admin-file-input" class="form-label">Add Image</label>
                            <input class="form-control" name="image_path" type="file" id="admin-file-input">
                        </div>
                        

                    </div>

                    <div class="mb-3">
                    
                        <div class="form-check form-switch">
                            <input onclick="toggleInteractiveEx()" class="form-check-input" type="checkbox" id="switch-iex" >
                            <label class="form-check-label" for="switch-iex">Add interactive exercise</label>
                        </div>
                        

                        <div class="mb-3" id="toggle-iex">

                            <input class="form-control" name="exercise_path" type="file" id="admin-file-input">

                        </div>

        

                    </div>

                    <div class="mb-3">

                        <div class="form-check form-switch">
                            <input onclick="toggleEvaluation()" class="form-check-input" type="checkbox" id="switch-test">
                            <label class="form-check-label" for="switch-test">Add evaluation</label>
                        </div>

                        <div class="mb-3" id="evaluation-form">

                            <input class="form-control" name="test_path" type="file" id="admin-file-input">

                        </div>

                    </div>   
                     
                    <div class="mb-3">

                        <div class="form-check form-switch">
                            <input onclick="toggleSlider()" class="form-check-input" type="checkbox" id="switch-slider">
                            <label class="form-check-label" for="switch-test">Add slider image</label>
                        </div>

                        <div class="mb-3" id="slider-form">

                            <input class="form-control" name="slider_path" type="file" id="admin-file-input">

                        </div>

                    </div>  
               

                    <button type="submit" name="update-page" class="btn btn-light admin-form-btn">Update</button>
                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>