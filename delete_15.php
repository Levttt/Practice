<?php
$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');

$id = $_GET['id'];

$sql = 'SELECT * FROM users.images WHERE id = :id LIMIT 1';
$query = $pdo->prepare($sql);
$query->execute(['id'=>$id]);
$record = $query->fetch();

$imgUrl = __DIR__ . 'img/demo/gallery/' . $record['img_name'];
if(file_exists($imgUrl)){
    unlink($imgUrl);
}

$sql = 'DELETE FROM users.images WHERE id = (:id)';
$query = $pdo->prepare($sql);
$query->execute(['id'=>$id]);

header('Location: /task_15_1.php');