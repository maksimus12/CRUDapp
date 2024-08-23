<?php 

use Core\Database;
use Core\App;
use Core\Validator;

$db = App::resolve(Database::class);


$currentUserId = 3;


    $note = $db->query('select * from posts where id = :id', [
        'id' => $_POST['id']
    ])->findOrFail();
    
authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}


if(count($errors)){
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update posts set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

header('Location: /notes');
die();