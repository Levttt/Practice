<?php
session_start();

if(isset($_POST['button'])){
    $_SESSION['click']++;
    header('Location: /task_13.php');
}
