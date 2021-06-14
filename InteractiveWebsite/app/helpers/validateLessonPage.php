<?php 

function validateLessonPage($lesson_page){

    $errors = array();

    if(empty($lesson_page['paragraph'])){

        array_push($errors, 'Paragraph is required');
    }
    
    return $errors; 
}