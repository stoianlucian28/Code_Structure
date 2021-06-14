<?php 

function validateLesson($lesson){

    $errors = array();

    
    if(empty($lesson['title'])){

        array_push($errors, 'Title is required');
    }

    if(empty($lesson['subtitle'])){

        array_push($errors, 'Subtitle is required');
    }

    $existingLesson = selectOne('lessons', ['title' => $lesson['title']]);

    if($existingLesson){

        if(isset($lesson['update-lesson']) && $existingLesson['id'] != $lesson['id']){

            array_push($errors, 'A lesson with the same name already exists');
        }

        if(isset($course['add-lesson'])){

            array_push($errors, 'A lesson with the same name already exists');
        }
    }

    return $errors;
}