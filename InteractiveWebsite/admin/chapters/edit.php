<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "\app\controllers\chapters.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();


?>


<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Dashboard - Edit Chapter</title>
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
                    Edit chapter
                </h2>


                <form action="edit.php" method="post" class="admin-form">
                        
                    <?php include("../../app/helpers/formErrors.php");?>

                    <div class="mb-3">
                        <input type="hidden" name="id"  value="<?php echo $id; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="admin-title-input" class="form-label">Chapter Title</label>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" id="admin-title-input">
                    </div>

                    
                    <div class="mb-3">
                        <label for="admin-title-input" class="form-label">Chapter Subtitle</label>
                        <input type="text" name="subtitle" value="<?php echo $subtitle; ?>" class="form-control" id="admin-title-input">
                    </div>
                    
                    
                    <div class="mb3">
                        
                        <select class="form-select select-chapter" name="course_id">

                            <option value=""></option>
                            
                            <?php foreach($courses as $key => $course): ?>
                                
                                <?php if(!empty($course_id) && $course_id == $course['id']): ?>

                                    <option selected value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>

                                <?php else: ?>

                                    <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>

                                <?php endif;?>

                            <?php endforeach; ?>
                       
                            
                        </select>

                    </div>

                    <button type="submit" name="update-chapter" class="btn btn-light admin-form-btn">Edit</button>
                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>