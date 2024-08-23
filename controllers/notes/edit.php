<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);


$currentUserId = 3;


    $note = $db->query('select * from posts where id = :id', [
        'id' => $_GET['id']
    ])->findOrFail();
    
    authorize($note['user_id'] === $currentUserId);

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);