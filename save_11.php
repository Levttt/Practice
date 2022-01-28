<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');

$sql = 'SELECT * FROM users.users WHERE email =:email';
$query = $pdo->prepare($sql);
$query->execute(['email'=>$email]);
$check = $query->fetch(PDO::FETCH_ASSOC);

if(!empty($check)){
    $_SESSION['record'] = 1;
    header('Location: /task_11_handler.php');
    exit;
} else {
    $sql = 'INSERT INTO users.users (email, password) VALUES (:email, :password)';
    $query = $pdo->prepare($sql);
    $query->execute(['email'=>$email, 'password'=>$hash]);
    $_SESSION['record'] = 2;
    header('Location: /task_11_handler.php');
    exit;
}