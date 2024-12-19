<?php
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);


$currentUserId = $_SESSION['user']['user_id'];


    $meeting = $db->query('SELECT posts.id as post_id,
                        students.id as student_id,
                        users.id as user_id,
                        students.fname,
                        posts.topic,
                        posts.body
                        FROM posts
                        INNER JOIN users ON posts.user_id = users.id
                        INNER JOIN students ON posts.student_id = students.id
                        where posts.id = :id', [
                        'id' => $_GET['id']
                        ])->findOrFail();
    
    authorize($meeting['user_id'] === $currentUserId);
    
    view("meetings/show.view.php", [
        'heading' => 'Meeting',
        'meeting' => $meeting,
    ]);
