<?php 

$table = 'user_progress';
$users_progress = selectAll($table);

if(isset($_POST['access-course'])){

    unset($_POST['access-course']);

    $progress_id = create($table, $_POST);
    exit();
    
}