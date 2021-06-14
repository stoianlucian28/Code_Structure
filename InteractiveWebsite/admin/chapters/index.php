<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "\app\controllers\chapters.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();


$courses = selectAll('courses');

$per_page_record = 20; //Display the number of rows per page in table

if(isset($_GET['page'])){

    $page = $_GET['page'];
}
else{

    $page = 1;
}

$start_from = ($page-1) * $per_page_record;    

$path = '/admin/chapters/index.php?page=';
$table = 'chapters';
$query = "SELECT * FROM $table LIMIT $start_from, $per_page_record";
$rs_result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Dasboard - Chapters</title>
     <!-- HEAD // HEAD // HEAD -->
     <?php include("../../includePHP/head.php"); ?>
</head>
<body>

    <?php include("../../includePHP/dashboardHeader.php"); ?>
    <?php include("../../includePHP/dashboardBar.php"); ?>

    <div class="admin-content">

        <div class="index-table-container">

            <div class="container-fluid">

                <a href="<?php echo BASE_URL . '/admin/chapters/create.php'?>" class="btn btn-light admin-create-link-btn">
            
                    Add chapter

                </a>

                <h2 class="index-table-title">
                    Manage Chapters
                </h2>

                <?php include("../../includePHP/messages.php"); ?>

                <table class="table index-table">

                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Course</th>
                        <th colspan="3" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row = mysqli_fetch_array($rs_result)):?>
                            
                            <tr>

                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['title']; ?></td>
                                <?php foreach($courses as $course): ?>
                                    <?php if($course['id'] == $row['course_id']): ?>
                                        <td><?php echo $course['title']?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><a href="/InteractiveWebsite/admin/chapters/edit.php?id=<?php echo $row['id']; ?>" class="action-btn admin-edit">Edit</a></td>
                                <td><a href="/InteractiveWebsite/admin/chapters/index.php?del_id=<?php echo $row['id']; ?>" class="action-btn admin-delete">Delete</a></td>

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