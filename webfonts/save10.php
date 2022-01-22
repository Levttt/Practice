<?php

$text = $_POST['text'];

$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');
$sql = 'INSERT INTO users.task_ten (text) VALUES (:text)';
$query = $pdo->prepare($sql);
$query->execute(['text'=>$text]);

?>
