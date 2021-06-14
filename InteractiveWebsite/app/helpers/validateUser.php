<?php



function validateUser($user)
{     
    $errors = array();

    if(empty($user['email'])){

        array_push($errors, 'Email is required');
    }
    
    if(empty($user['first_name'])){

        array_push($errors, 'First Name is required');
    }

    if(empty($user['last_name'])){

        array_push($errors, 'LastName is required');
    }

    if(empty($user['password'])){

        array_push($errors, 'Password is required');
    }

    if(empty($user['confirm_password'])){

        array_push($errors, 'You have to confirm your password');
    }

    if($user['confirm_password'] !== $user['password']){

        array_push($errors, 'Password do not match');
    }

    $existingUser = selectOne('users', ['email' => $user['email']]);

    if($existingUser){

    
        if(isset($user['update-admin']) && $existingUser['id'] != $user['id']){

            array_push($errors, 'Email already exists');
        }

        if(isset($user['create-admin'])){

            array_push($errors, 'Email already exists');
        }
    }

    return $errors;
}

function validateLogin($user){

    $errors = array();

    if(empty($user['email'])){

        array_push($errors, 'Email is required');
    }

    if(empty($user['password'])){

        array_push($errors, 'Password is required');
    }

    return $errors;
}

function validatePersonalInfo($user){

    $errors = array();

    if(empty($user['email'])){

        array_push($errors, 'Email is required');
    }
    
    if(empty($user['first_name'])){

        array_push($errors, 'First Name is required');
    }

    if(empty($user['last_name'])){

        array_push($errors, 'LastName is required');
    }

    $existingUser = selectOne('users', ['email' => $user['email']]);

    if($existingUser){
    
        if(isset($user['update-account-info']) && $existingUser['id'] != $user['id']){

            array_push($errors, 'Email already exists');
        }

    }

    return $errors;

}

function validateAccountPass($user){
    $errors = array();

    if(empty($user['password'])){

        array_push($errors, 'Password is required');
    }

    if(empty($user['confirm_password'])){

        array_push($errors, 'You have to confirm your password');
    }

    if($user['confirm_password'] !== $user['password']){

        array_push($errors, 'Password do not match');
    }
    
    return $errors;

}