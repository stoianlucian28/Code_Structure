<?php 


include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/lessons.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();



$per_page_record = 20; //Display the number of rows per page in table

if(isset($_GET['page'])){

    $page = $_GET['page'];
}
else{

    $page = 1;
}

$start_from = ($page-1) * $per_page_record;    

$table = 'lessons';
$path = '/admin/lessons/index.php?page=';
$query = "SELECT * FROM $table LIMIT $start_from, $per_page_record";
$rs_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Dasboard - Lessons</title>
     <!-- HEAD // HEAD // HEAD -->
     <?php include("../../includePHP/head.php"); ?>
</head>
<body>

    <?php include(STANDARD_PATH . "/includePHP/dashboardHeader.php"); ?>
    <?php include(STANDARD_PATH . "/includePHP/dashboardBar.php"); ?>

    <div class="admin-content">

        <div class="index-table-container">

            <div class="container-fluid">

                <?php include("../../includePHP/messages.php"); ?>

                <a href="<?php echo BASE_URL . '/admin/lessons/create.php'?>" class="btn btn-light admin-create-link-btn">
            
                    Create lesson

                </a>


                <h2 class="index-table-title">
                    Manage Lessons
                </h2>

                <a href="<?php echo BASE_URL . '/admin/lesson-pages/index.php'?>" class="btn btn-light admin-create-link-btn">
            
                    Add Page

                </a>

                <table class="table index-table">

                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <!-- <th scope="col">Course</th> -->
                        <th scope="col">Title</th>
                        <th scope="col">Admin</th>
                        <th colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_array($rs_result)):?>

                            <tr>

                                <th scope="row"><?php echo $row['id'];?></th>
                                <td><?php echo $row['title']; ?></td>
                                <td>Admin</td>
                                <td><a href="/InteractiveWebsite/admin/lessons/edit.php?id=<?php echo $row['id']; ?>" class="action-btn admin-edit">Edit</a></td>
                                <td><a href="/InteractiveWebsite/admin/lessons/edit.php?del_id=<?php echo $row['id']; ?>" class="action-btn admin-delete">Delete</a></td>

                            </tr>

                        <?php endwhile;?>

                    </tbody>

                </table>

                <?php include(STANDARD_PATH . '/includePhp/pagination.php');?>

            </div>

        </div>

    </div>
    


    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>