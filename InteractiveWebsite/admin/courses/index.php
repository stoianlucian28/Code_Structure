<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/courses_controller.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();


$chapters = selectAll('chapters');
$chapter_num = 0;


$per_page_record = 20; //Display the number of rows per page in table

if(isset($_GET['page'])){

    $page = $_GET['page'];
}
else{

    $page = 1;
}

$start_from = ($page-1) * $per_page_record;    

$table = 'courses';
$path = '/admin/courses/index.php?page=';
$query = "SELECT * FROM $table LIMIT $start_from, $per_page_record";
$rs_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Dasboard - Courses</title>
     <!-- HEAD // HEAD // HEAD -->
     <?php include("../../includePHP/head.php"); ?>
</head>
<body>

    <?php include("../../includePHP/dashboardHeader.php"); ?>
    <?php include("../../includePHP/dashboardBar.php"); ?>

    <div class="admin-content">

        <div class="index-table-container">

            <div class="container-fluid">

                <a href="<?php echo BASE_URL . '/admin/courses/create.php'?>" class="btn btn-light admin-create-link-btn">
            
                    Create course

                </a>

                <h2 class="index-table-title">
                    Manage Courses
                </h2>

                <?php include("../../includePHP/messages.php"); ?>

                <table class="table index-table">

                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Chapters</th>
                        <!-- <th scope="col">Admin</th> -->
                        <th colspan="3" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row = mysqli_fetch_array($rs_result)): ?>
                            
                            <tr>

                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['title']; ?></td>
                                <?php foreach($chapters as $chapter): ?>
                                    <?php if($chapter['course_id'] == $row['id']): ?>
                                    
                                        
                                            <?php 
                                            
                                                $chapter_num = $chapter_num + 1;
                                                

                                            ?>
                                            
                                        
                                    
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><?php echo $chapter_num; ?></td>
                                <?php $chapter_num = 0;?>
                                <td><a href="/InteractiveWebsite/admin/courses/edit.php?id=<?php echo $row['id']; ?>" class="action-btn admin-edit">Edit</a></td>
                                <td><a href="/InteractiveWebsite/admin/courses/index.php?del_id=<?php echo $row['id']; ?>" class="action-btn admin-delete">Delete</a></td>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

                <?php include(STANDARD_PATH . '/includePhp/pagination.php');?>

            </div>

        </div>

    </div>
    


    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>