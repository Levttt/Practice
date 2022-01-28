<?php
session_start();

$text = $_POST['text'];

$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');

$sql = 'SELECT * FROM users.task_ten WHERE text = :text';
$query = $pdo->prepare($sql);
$query->execute(['text'=>$text]);
$task = $query->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
        $_SESSION['danger'] = TRUE;
        header("Location: /task_10.php");
        exit;
}
elseif (empty($task)){
    $sql = 'INSERT INTO users.task_ten (text) VALUES (:text)';
    $query = $pdo->prepare($sql);
    $query->execute(['text'=>$text]);
    $_SESSION['record'] = TRUE;
    header("Location: /task_10.php");
    exit;
}
?>