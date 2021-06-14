<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/lessons.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();


?>


<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Dashboard - Edit Lesson</title>
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
                    Update lesson
                </h2>

            

                <form action="edit.php" method="post" class="admin-form" enctype = "multipart/form-data">
                
                    <?php include("../../app/helpers/formErrors.php");?>
                    
                    <div class="mb-3">
                        <input type="hidden" name="id"  value="<?php echo $id; ?>">
                    </div>

                    <div class="mb3">
                        
                        <label for="" class="form-label">Select chapter</label>
                        <select class="form-select" name="chapter_id"  aria-label="Default select example">

                            <option value=""></option>
                            
                            <?php foreach($courses as $key => $course): ?>

                               

                                    <optgroup value="<?php echo $course['id'];?>" label="<?php echo $course['title']; ?>">
                                        
                                        <?php foreach($chapters as $key => $chapter):?>

                                            <?php if($chapter['course_id'] == $course['id']): ?>

                                                <?php if(!empty($chapter_id) && $chapter_id == $chapter['id']): ?>
                                                
                                                    <option selected value="<?php echo $chapter['id'];?>"><?php echo $chapter['title']; ?></option>

                                                <?php else: ?>

                                                    <option value="<?php echo $chapter['id'];?>"><?php echo $chapter['title']; ?></option>

                                                <?php endif;?>

                                            <?php endif;?>

                                        

                                        <?php endforeach;?>

                                    
                                     <optgroup>

                            <?php endforeach; ?>
                       
                            
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="admin-title-input" class="form-label">Lesson Title</label>
                        <input type="text" name="title" value="<?php echo $title;?>" class="form-control" id="admin-title-input">
                    </div>

                    <div class="mb-3">
                        <label for="lesson-description" class="form-label">Lesson Subtitle</label>
                        <input type="text" name="subtitle"  value="<?php echo $subtitle; ?>" class="form-control" id="admin-title-input">
                    </div>

                    
                    <div class="mb-3">
                        <label for="admin-file-input" class="form-label">Add Image</label>
                        <input class="form-control" name="image_path" type="file" id="admin-file-input">
                    </div>

                    <button type="submit" name="update-lesson" class="btn btn-light admin-form-btn">Edit</button>
                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>