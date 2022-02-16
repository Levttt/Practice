<?php

$name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');

while (@list($key,$value) = each($_FILES['image']['name'])){
    $fileName = time() . mt_rand(0,1000000) . $value;
    $add = "img/demo/gallery/" . $fileName;

    copy($_FILES['image']['tmp_name'][$key], $add);

    $sql = 'INSERT INTO users.images (img_name) VALUES (:text)';
    $query = $pdo->prepare($sql);
    $query->execute(['text'=>$fileName]);
}

header('Location: /task_15_2.php');