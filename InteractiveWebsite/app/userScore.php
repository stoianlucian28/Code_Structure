<?php 

$users_progress = selectAll('user_progress');

//Getting the number of completed exercises
$exercsises_table = selectAll('exercises', ['user_id' => $_SESSION['id'], 'finished' => '1']);
$finished_exercises = count($exercsises_table);

//Getting the number of completed quizes
$quizes_table = selectAll('quizes', ['user_id' => $_SESSION['id'], 'finished' => '1']);
$practice_quizes = selectAll('practice_quizes', ['user_id' => $_SESSION['id'], 'finished' => '1']);
$finished_quizes = count($quizes_table) + count($practice_quizes);

//Getting the score of current logged user

$user_score = selectOne('user_score', ['user_id' => $user['id']]);
