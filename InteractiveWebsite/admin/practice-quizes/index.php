<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/practice-quizes.php");
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

$table = 'practice';
$path = '/admin/practice-quizes/index.php?page=';
$query = "SELECT * FROM practice LIMIT $start_from, $per_page_record";
$rs_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Dasboard - Practice</title>
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

                <a href="<?php echo BASE_URL . '/admin/practice-quizes/create.php'?>" class="btn btn-light admin-create-link-btn">
            
                    Add quiz

                </a>

                <h2 class="index-table-title">
                     Practice Quizes
                </h2>

                <table class="table index-table">

                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Quiz title</th>
                        <th colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       
                    <?php while($row = mysqli_fetch_array($rs_result)):?>
                    

                        <tr>

                            <th scope="row"><?php echo $row['id'];?></th>

                            <?php foreach($courses as $course): ?>
                                <?php if($course['id'] == $row['course_id']): ?>
                                    <td><?php echo $course['title']?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            
                            <td><?php echo $row['title'];?></td>

                            <td><a href="/InteractiveWebsite/admin/practice-quizes/edit.php?id=<?php echo $row['id']; ?>" class="action-btn admin-edit">Edit</a></td>
                            <td><a href="/InteractiveWebsite/admin/practice-quizes/edit.php?del_id=<?php echo $row['id']; ?>" class="action-btn admin-delete">Delete</a></td>

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