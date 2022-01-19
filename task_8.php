<?php

/*
 * Креды для подключения к БД.
 */



$user = 'root';
$password = 'root';
$db = 'users';
$host = 'localhost';

/*
 * Массив с данными о пользователе.
 */

$dbArrayUsers = [
                    ['first_name'=>'Mark', 'last_name'=>'Otto', 'username'=>'@mdo'],
                    ['first_name'=>'Jacob', 'last_name'=>'Thornton', 'username'=>'@fat'],
                    ['first_name'=>'Larry', 'last_name'=>'the Bird', 'username'=>'@twitter'],
                    ['first_name'=>'Larry the Bird', 'last_name'=>'Bird', 'username'=>'@twitter']
                ];

/*
 * Массив с данными о ссылках.
 */

$dbArrayLinks = [
                    ['link_href_id'=>5, 'link_name'=>'Редактировать'],
                    ['link_href_id'=>6, 'link_name'=>'Изменить'],
                    ['link_href_id'=>7, 'link_name'=>'Удалить']
                ];

/*
 * Подключаюсь к БД с помощью кредов, используя PDO.
 */

$dsn = 'mysql:host=' . $host . ';dbname =' . $db;
$pdo = new PDO($dsn, $user, $password);

/*
 * Создал 2 таблицы, ибо данные о пользователе и данные о ссылках должны храниться в разных таблицах.
 * Для своего удобства сначала дропаю таблицы, потом создаю их, ибо код выполнялся множество раз, пока писал.
 */

$sql = 'DROP TABLE IF EXISTS users.task_seven;
        CREATE TABLE users.task_seven
(
    user_id int unsigned auto_increment
        primary key,
    first_name varchar(25)  null,
    last_name varchar(25)  null,
    username varchar(25) null
);

DROP TABLE IF EXISTS users.task_seven_links;
        CREATE TABLE users.task_seven_links
(
    id int unsigned auto_increment
        primary key,
    link_href_id text null,
    link_name text null
)
';

$query = $pdo->prepare($sql);
$query->execute();

/*
 * Заполняю таблицу БД с пользователями, используя массив на строке 18.
 */

foreach ($dbArrayUsers as $val){
    $sql = 'INSERT INTO users.task_seven(first_name,  last_name,  username) 
            VALUES                     (:first_name, :last_name, :username)';
    $query = $pdo->prepare($sql);
    $query->execute(['first_name'=>$val['first_name'], 'last_name'=>$val['last_name'], 'username'=>$val['username']]);
}

/*
 * Заполняю таблицу БД со ссылками, используя массив на строке 29.
 */

foreach ($dbArrayLinks as $val){
    $sql = 'INSERT INTO users.task_seven_links(link_href_id,  link_name)
            VALUES                           (:link_href_id, :link_name)';
    $query = $pdo->prepare($sql);
    $query->execute(['link_href_id'=>$val['link_href_id'], 'link_name'=>$val['link_name']]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
        <main id="js-page-content" role="main" class="page-content">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <h5 class="frame-heading">
                                Обычная таблица
                            </h5>
                            <div class="frame-wrap">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            $query = $pdo->query('SELECT * FROM users.task_seven');
                                            $tasks = $query->fetchAll(PDO::FETCH_ASSOC);

                                            /*
                                             * Здесь хотелось бы понять: как можно вставить данные из второй таблицы(users.task_seven_links),
                                             * в циклы foreach или while, которые уже выводят данные из первой таблицы(users.task_seven)
                                             * так, чтоб всё корректно отображалось?
                                             * Если нельзя использовать LEFT JOIN или UNION ALL, тк. у этих таблиц нет ничего общего
                                             * и при слиянии этих таблиц, используя UNION - данные на выходе будут отображаться некорректно.
                                             *
                                             * $querytest = $pdo->query('SELECT * FROM users.task_seven_links');
                                             * $tasktest = $querytest->fetchAll(PDO::FETCH_ASSOC);
                                             */

                                                foreach ($tasks as $row){
                                                    echo '<tr>
                                            <th scope="row">' . $row['user_id'] . '</th>
                                            <td>' . $row['first_name'] . '</td>
                                            <td>' . $row['last_name'] . '</td>
                                            <td>' . $row['username'] . '</td>
                                            <td>
                                                <a href="show.php?id=' . $row['user_id'] . '" class="btn btn-info">Редактировать</a>
                                                <a href="edit.php?id=' . $row['user_id'] . '" class="btn btn-warning">Изменить</a>
                                                <a href="delete.php?id=' . $row['user_id'] . '" class="btn btn-danger">Удалить</a>
                                            </td>
                                        </tr>';
                                              }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            // default list filter
            initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
            // custom response message
            initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
        </script>
    </body>
</html>