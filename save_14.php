<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=users;', 'root', 'root');

$sql = 'SELECT * FROM users.users WHERE email =:email';
$query = $pdo->prepare($sql);
$query->execute(['email'=>$email]);
$check = $query->fetch(PDO::FETCH_ASSOC);

if(password_verify($password,$check['hash'])) {
    $_SESSION['loginStatus'] = 2; //Статус когда пользователь ввёл верные данные и вошёл.
    $_SESSION['login'] = $check['user_name']; //Записываю имя пользователя в сессию.
    header('Location: /task_14.php');
    exit;
} else {
    $_SESSION['login'] = 1; //Статус когда пользователь ввёл неверные данные и не вошёл.
    header('Location: /task_14.php');
    exit;
}