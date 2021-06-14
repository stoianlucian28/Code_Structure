<?php

include("includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/users.php");

$users = selectAll('users');
$users_score = selectAll('user_score');

$per_page_record = 3; //Display the number of rows per page in table

//GET variable for page

if(isset($_GET['page'])){

    $page = $_GET['page'];
}
else{

    $page = 1;
}

$start_from = ($page-1) * $per_page_record;    

// $query = "SELECT * FROM users LIMIT $start_from, $per_page_record";
$table = 'user_score';
$path = '/leaderboard.php?page=';

$query = "SELECT users.id, users.first_name, users.last_name, user_score.score, row_number() OVER (order by user_score.score desc) 
as rank FROM users INNER JOIN user_score ON users.id = user_score.user_id LIMIT $start_from, $per_page_record";

$rs_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CodeStructure - Leaderboard</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

    <?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>

    <div class="leaderboard-container">
    
        <div class="container-fluid">
        
            <div class="leaderboard-header">
            
                <h2 class="leaderboard-header-title">Leaderboard</h2>
            
            </div>

            <div class="leaderboard-table-container">

            <table class="table leaderboard-table">

                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Score</th>
                    </tr>
                </thead>

                <tbody>
          
                <?php while($row = mysqli_fetch_array($rs_result)):?>
                        
                    <tr>
                        
                        <th scope="row"><?php echo $row['rank']; ?></th>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['last_name'];?></td>
                        <td><?php echo $row['score'];?></td>
                        
                    </tr>
                    
                <?php endwhile;?>

                </tbody>
                
            </table>

            <?php include(STANDARD_PATH . '/includePhp/pagination.php');?>

            </div>

        </div>
        
    </div>
    
</div>

    <?php include(STANDARD_PATH . "/includePHP/footer.php"); ?>

</body>

</html>