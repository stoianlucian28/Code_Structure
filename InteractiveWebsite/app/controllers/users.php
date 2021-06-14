<?php

include(STANDARD_PATH .'\app\database\db.php');
include(STANDARD_PATH .'\app\helpers\validateUser.php');

$table = 'users';
$admin_users = selectAll($table, ['admin' => 1]);

$errors = array();
$id = '';
$email = '';
$admin = '';
$first_name = '';
$last_name = '';
$password = '';
$confirm_password = '';



function loginUser($user){

    //Log user in
    $_SESSION['id'] = $user['id'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';
        
    if($_SESSION['admin']){
            
        header('location: ' . BASE_URL . '/admin/dashboard.php');
    }
    else{

        header('location: ' . BASE_URL . '/courses.php');
        
    }

    exit();
}

if(isset($_POST['register-btn']) || isset($_POST['create-admin'])){

    $errors = validateUser($_POST);

    if(count($errors) === 0){
        
        unset($_POST['register-btn'], $_POST['confirm_password'], $_POST['create-admin'] );
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if(isset($_POST['admin'])){

            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = 'Admin account was created successfuly';
            $_SESSION['type'] = 'alert-success';
            header('location: ' . BASE_URL . '/admin/users/index.php');
            exit();
        }
        else{

            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            $user_score_id = create('user_score', ['user_id' => $user['id']]);
            loginUser($user);
            
        }

    }
    else{

        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $first_name =  $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $password =  $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    }
   
}

if(isset($_POST['update-admin'])){

    $errors = validateUser($_POST);

    if(count($errors) === 0){
        
        $id = $_POST['id'];
        unset($_POST['confirm_password'], $_POST['update-admin'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $count = update($table, $id ,$_POST);
        $_SESSION['message'] = 'Admin account was updated successfuly';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
        
    }
    else{

        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $first_name =  $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $password =  $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    }
}

if(isset($_POST['update-account-info'])){

    $errors = validatePersonalInfo($_POST);

    if(count($errors) === 0){
        
        $id = $_POST['id'];
        unset($_POST['update-account-info'], $_POST['id']);

        $count = update($table, $id ,$_POST);
        $_SESSION['message'] = 'Personal info was updated successfuly!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/profile/account.php');
        exit();
        
    }
    else{

        $email = $_POST['email'];
        $first_name =  $_POST['first_name'];
        $last_name =  $_POST['last_name'];
    }
}

if(isset($_POST['update-account-pass'])){

    $errors = validateAccountPass($_POST);

    if(count($errors) === 0){

        $id = $_POST['id'];
        unset($_POST['confirm_password'] ,$_POST['update-account-pass'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $count = update($table, $id ,$_POST);
        $_SESSION['message'] = 'Password was updated successfuly!';
        $_SESSION['type'] = 'alert-success';
        header('location: ' . BASE_URL . '/profile/account.php');
        exit();
    }
}

if(isset($_GET['id'])){

    $admin_user = selectOne($table, ['id' => $_GET['id']]);
    
    $id = $admin_user['id'];
    $email = $admin_user['email'];
    $admin = isset($admin_user['admin']) ? 1 : 0;
    $first_name = $admin_user['first_name'];
    $last_name = $admin_user['last_name'];


}

if(isset($_POST['login-btn'])){

    $errors = validateLogin($_POST);

    if(count($errors) === 0){

        $user = selectOne($table, ['email' => $_POST['email']]);

        if($user && password_verify($_POST['password'], $user['password'])){

            loginUser($user);
        }
        else{

            array_push($errors, 'Email or password are wrong');
        }
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}


if(isset($_GET['del_id'])){

    $count = delete($table, $_GET['del_id']);
    $_SESSION['message'] = 'Admin account was deleted successfuly';
    $_SESSION['type'] = 'alert-success';
    header('location: ' . BASE_URL . '/admin/users/index.php');
    exit();
    
}

