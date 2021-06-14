<?php

function validateCourse($course)
{     
    $errors = array();

    
    if(empty($course['title'])){

        array_push($errors, 'Title is required');
    }

    if(empty($course['subtitle'])){

        array_push($errors, 'Subtitle is required');
    }

    if(empty($course['description'])){

        array_push($errors, 'Description is required');
    }

    $existingCourse = selectOne('courses', ['title' => $course['title']]);

    if($existingCourse){

        
        if(isset($course['update-course']) && $existingCourse['id'] != $course['id']){

            array_push($errors, 'A course with the same name already exists');
        }

        if(isset($course['add-course'])){

            array_push($errors, 'A course with the same name already exists');
        }
    }

    return $errors;
}
