<?php

$name = $_FILES['image']['name'];
$fileName = time() . mt_rand(0,1000000) . $name;
$tmp_name = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp_name, "img/demo/gallery/" . $fileName);

$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');

$sql = 'INSERT INTO users.images (img_name) VALUES (:text)';
$query = $pdo->prepare($sql);
$query->execute(['text'=>$fileName]);

header('Location: /task_15.php');