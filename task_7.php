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

$dbArray =   [   ['imgPath' => 'img/demo/authors/sunny.png', 'imgName' => 'Sunny A.', 'userName' => 'Sunny A. (UI/UX Expert)',
    'position' => 'Lead Author', 'twitterHref' => 'https://twitter.com/@myplaneticket', 'twitterName' => '@myplaneticket',
    'bootstrapHref' => 'https://wrapbootstrap.com/user/myorange', 'title' => 'Contact Sunny', 'isBanned' => '0'],
    ['imgPath' => 'img/demo/authors/josh.png', 'imgName' => 'Jos K.', 'userName' => 'Jos K. (ASP.NET Developer)',
        'position' => 'Partner &amp; Contributor', 'twitterHref' => 'https://twitter.com/@atlantez', 'twitterName' => '@atlantez',
        'bootstrapHref' => 'https://wrapbootstrap.com/user/Walapa', 'title' => 'Contact Jos', 'isBanned' => '0'],
    ['imgPath' => 'img/demo/authors/jovanni.png', 'imgName' => 'Jovanni Lo', 'userName' => 'Jovanni L. (PHP Developer)',
        'position' => 'Partner &amp; Contributor', 'twitterHref' => 'https://twitter.com/@lodev09', 'twitterName' => '@lodev09',
        'bootstrapHref' => 'https://wrapbootstrap.com/user/lodev09', 'title' => 'Contact Jovanni', 'isBanned' => '1'],
    ['imgPath' => 'img/demo/authors/roberto.png', 'imgName' => 'Jovanni Lo', 'userName' => 'Roberto R. (Rails Developer)',
        'position' => 'Partner &amp; Contributor', 'twitterHref' => 'https://twitter.com/@sildur', 'twitterName' => '@sildur',
        'bootstrapHref' => 'https://wrapbootstrap.com/user/sildur', 'title' => 'Contact Roberto', 'isBanned' => '1']
];

/*
 * Подключаюсь к БД с помощью кредов, используя PDO
 */

$dsn = 'mysql:host=' . $host . ';dbname =' . $db;
$pdo = new PDO($dsn, $user, $password);

/*
 * Для своего удобства сначала дропаю таблицу, потом её создаю, ибо код выполнялся множество раз, пока писал.
 */

$sql = 'DROP TABLE IF EXISTS users.users;
        CREATE TABLE users.users
(
    user_id int unsigned auto_increment
        primary key,
    name varchar(50)  null,
    img_name text  null,
    img_path text null,
    position text null,
    twitter_href text null,
    twitter_name varchar(50) null,
    bootstrap_href text null,
    title text null,
	is_banned tinyint null
)
ENGINE = MyISAM COLLATE = utf8_general_ci;
';

$query = $pdo->prepare($sql);
$query->execute();

/*
 * Используя foreach, ввожу данные пользователей.
 */

foreach ($dbArray as $val){
    $sql = 'INSERT INTO users.users(name, img_name, img_path, position, twitter_href, twitter_name, bootstrap_href, title, is_banned) 
            VALUES (:userName, :imgName, :imgPath, :position, :twitterHref, :twitterName, :bootstrapHref, :title, :isBanned)';
    $query = $pdo->prepare($sql);
    $query->execute([
                     'userName'=>$val['userName'], 'imgName'=>$val['imgName'], 'imgPath'=>$val['imgPath'], 'position'=>$val['position'],
                     'twitterHref'=>$val['twitterHref'], 'twitterName'=>$val['twitterName'], 'bootstrapHref'=>$val['bootstrapHref'],
                     'title'=>$val['title'], 'isBanned'=>$val['isBanned']
                    ]);
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
                    <div class="d-flex flex-wrap demo demo-h-spacing mt-3 mb-3">
                        <?php

                        /*
                         * Беру данные из БД, с помощью while вставляю их.
                         */

                        $query = $pdo->query('SELECT * FROM users.users');
                        while($row = $query->fetch(PDO::FETCH_ASSOC)){
                            if($row['is_banned'] == 0){
                                echo '<div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">';
                            }
                            elseif ($row['is_banned'] == 1){
                                echo '<div class="banned rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">';
                            }
                            echo '<img src="' . $row['img_path'] . '" alt="' . $row['img_name'] . '" class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
        <div class="ml-2 mr-3">
            <h5 class="m-0">' . $row['name'] . '<small class="m-0 fw-300">' . $row['position'] . '</small>
                <a href="' . $row['twitter_href'] . '" class="text-info fs-sm" target="_blank">' . $row['twitter_name'] . '</a> -
                <a href="' . $row['bootstrap_href'] . '" class="text-info fs-sm" target="_blank" title="' . '"><i class="fal fa-envelope"></i></a>
        </div>
    </div>';
                        }
                        ?>
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