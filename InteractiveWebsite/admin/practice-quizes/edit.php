<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/practice-quizes.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();


?>


<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Dashboard - Edit Practice</title>
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
                    Edit practice quiz
                </h2>

                <form action="create.php" method="post" class="admin-form" enctype = "multipart/form-data">

                    <?php include("../../app/helpers/formErrors.php");?>

                     
                    <div class="mb-3">
                        <input type="hidden" name="id"  value="<?php echo $id; ?>">
                    </div>
                    
                    <div class="mb3">

                        <label for="" class="form-label">Select course</label>
                        <select class="form-select select-chapter" name="course_id"  aria-label="Default select example">

                            <option value=""></option>
                            
                            <?php foreach($courses as $key => $course): ?>
                                
                                <?php if(!empty($course_id) && $course_id == $course['id']): ?>

                                    <option selected value="<?php echo $course['id'];?>"><?php echo $course['title']; ?></option>

                                <?php else: ?>

                                    <option value="<?php echo $course['id'];?>"><?php echo $course['title']; ?></option>

                                <?php endif;?>

                            <?php endforeach; ?>
                         
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="admin-paragraph-text" class="form-label">Quiz title</label>
                        <textarea class="form-control" name="title" id="admin-paragraph-text"><?php echo $title;?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="admin-paragraph-text" class="form-label">Quiz subtitle</label>
                        <textarea class="form-control" name="subtitle" id="admin-paragraph-text"><?php echo $subtitle;?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="admin-file-input" class="form-label">Add quiz image</label>
                        <input class="form-control" name="image_path" type="file" id="admin-file-input">
                    </div>

                    <div class="mb-3">
                        <label for="admin-file-input" class="form-label">Add quiz</label>
                        <input class="form-control" name="quiz_path" type="file" id="admin-file-input">
                    </div>

                    
               

                    <button type="submit" name="update-quiz" class="btn btn-light admin-form-btn">Edit quiz</button>
                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>