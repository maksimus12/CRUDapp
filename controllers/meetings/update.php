<?php 

use Core\Database;
use Core\App;
use Core\Validator;

$db = App::resolve(Database::class);


$currentUserId = $_SESSION['user']['user_id'];


    $meeting = $db->query('select * from posts where id = :id', [
        'id' => $_POST['id']
    ])->findOrFail();
    
authorize($meeting['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}


if(count($errors)){
    return view('meetings/edit.view.php', [
        'heading' => 'Edit meeting',
        'errors' => $errors,
        'meeting' => $meeting
    ]);
}

$db->query('update posts set body = :body, student_id = :student_id, topic = :topic where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body'],
    'student_id' => $_POST['student_id'],
    'topic' => $_POST['topic']
]);

header('Location: /meetings');
die();