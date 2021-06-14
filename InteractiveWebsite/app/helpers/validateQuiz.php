<?php 

function validateQuiz($quiz){

    $errors = array();

    if(empty($quiz['title'])){

        array_push($errors, 'Title is required');
    }
    
    if(empty($quiz['subtitle'])){

        array_push($errors, 'Subtitle is required');
    }

    $existingQuiz = selectOne('practice', ['title' => $quiz['title']]);

    if($existingQuiz){

        if(isset($quiz['update-quiz']) && $existingQuiz['id'] != $quiz['id']){

            array_push($errors, 'A quiz with the same title already exists');
        }

        if(isset($quiz['add-quiz'])){

            array_push($errors, 'A quiz with the same title already exists');
        }
    }

    return $errors; 
}