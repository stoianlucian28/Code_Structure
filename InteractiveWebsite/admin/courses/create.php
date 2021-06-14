<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/courses_controller.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();

?>


<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Dashboard - Add Course</title>
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
                    Create course
                </h2>

                <form action="create.php" method="post" class="admin-form" enctype = "multipart/form-data"> 
                    
                    <?php include("../../app/helpers/formErrors.php");?>

                    <div class="mb-3">
                        <label for="admin-title-input" class="form-label">Course Title</label>
                        <input type="text" name="title"  value="<?php echo $title; ?>" class="form-control" id="admin-title-input">
                    </div>

                    
                    <div class="mb-3">
                        <label for="admin-title-input" class="form-label">Course Subtitle</label>
                        <input type="text" name="subtitle"  value="<?php echo $subtitle; ?>" class="form-control" id="admin-title-input">
                    </div>

                    <div class="mb-3">
                        <label for="admin-paragraph-text" class="form-label">Course description</label>
                        <textarea class="form-control" name="description" id="admin-paragraph-text"><?php echo $description; ?></textarea>
                    </div>



                    <div class="mb-3">
                        <label for="admin-file-input" class="form-label">Add Image</label>
                        <input class="form-control" name="image_path" type="file" id="admin-file-input">
                    </div>


                    <button type="submit" name="add-course" class="btn btn-light admin-form-btn">Create</button>
                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>