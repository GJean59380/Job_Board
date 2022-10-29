<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= Router::makeURL("/public/style/style.css") ?>">
    <link rel="icon" href="<?= Router::makeURL("/public/img/indown-bleu-sans-fond.png") ?>">
    <script src="https://kit.fontawesome.com/b28ef48a42.js" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header id="header">
        <div class="title">
            <a href="<?= Router::makeURL("/") ?>">
                <img src="<?= Router::makeURL("/public/img/logo.png") ?>" alt="site logo" class="logo1">
                <img src="<?= Router::makeURL("/public/img/indown.png") ?>" class="logo2">
            </a>
        </div>
        <div class="searchbar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search here ...">
        </div>

        <div class="navbar">
            <ul>
                <?php if (isset($_SESSION["User"]["name"])) : ?>
                    <li><a href="<?= Router::makeURL("/user/".$_SESSION["User"]["id"]) ?>"><i class="fa-regular fa-user"></i></a></li>
                    <li><a href="<?= Router::makeURL("/user/logout")?>" ><i class="fa-solid fa-right-from-bracket"></i></a></li>
                <?php else : ?>
                    <li><a href="<?= Router::makeURL("/user/login") ?>"><i class="fa-regular fa-user"></i></a></li>
                <?php endif ?>

            </ul>
        </div>
    </header>

    <?= $content ?>

    <div class="footer">
        <footer>
            <?php if (isset($_SESSION["User"]["name"]) && $_SESSION["User"]["name"] != "") : ?>
                <p>Bonjour <?= $_SESSION["User"]["name"]?></p>
            <?php endif ?>
            <?php if (isset($_SESSION["User"]["name"]) && $_SESSION["User"]["privileges"] == 3) : ?>
                <a href="<?= Router::makeURL("/user") ?>">Voir tous les utilisateurs</a>
            <?php endif ?>
        </footer>
    </div>
</body>

</html>