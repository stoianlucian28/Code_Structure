<?php 

function usersOnly($redirect = "/index.php"){

    if(empty($_SESSION['id'])){

        $_SESSION['message'] = 'You have to login to access this page!';
        $_SESSION['type'] = 'alert-danger';
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}

function adminOnly($redirect = "/index.php"){

    if(empty($_SESSION['id']) || empty($_SESSION['admin'])){

        $_SESSION['message'] = 'You have to be logged in as an admin to access this page!';
        $_SESSION['type'] = 'alert-danger';
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}