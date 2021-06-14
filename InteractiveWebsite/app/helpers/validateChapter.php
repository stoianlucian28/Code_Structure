<?php 

function validateChapter($chapter)
{     
    $errors = array();

    if(empty($chapter['title'])){

        array_push($errors, 'Title is required');
    }
    
    if(empty($chapter['subtitle'])){

        array_push($errors, 'Subtitle is required');
    }

    if(empty($chapter['course_id'])){

        array_push($errors, 'You have to select a course');
    }

    $existingChapter = selectOne('chapters', ['title' => $chapter['title']]);

    if($existingChapter){

        if(isset($chapter['update-chapter']) && $existingChapter['id'] != $chapter['id']){

            array_push($errors, 'Chapter with this title already exists');
        }

        if(isset($chapter['add-chapter'])){

            array_push($errors, 'Chapter with this title already exists');
        }
       
    }

    return $errors;
}