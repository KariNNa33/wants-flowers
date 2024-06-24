<?php
    include "connect.php";
?>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Она хочет цветы</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/icon.png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="header_pages">
        <div class="container">
            <div class="head">
                <a href="index.php"><img class="logo" src="img/logo.png" alt="logo"></a>

                <!-- Меню сайта -->
                <div class="nav">
                    <div class="search">
                        <form action="search.php" method="POST">
                            <img class="" src="img/search.png" alt="Поиск">
                        </form>
                    </div>
                    <nav>
                        <a class="menu1" href="katalog.php">Каталог</a>
                        <a class="menu1" href="index.php#about">О магазине</a>
                        <a class="menu1" href="index.php#footer">Контакты</a>
                        <a class="menu1" href="production.php">Производство</a>
                    </nav>
                    <div class="cart_profile"><a href="error.php" class="menu2">Вологда</a>
                        <p class="menu3">8-900-534-44-66</p>
                        <?php
                            if(!isset($_SESSION['id'])){
                                ?>
                                    <a class="menu1" href="register.php"><img src="img/account.png" alt=""></a>
                                <?php
                            } else {
                                ?>
                                    <a href="card.php" class="btns"><img src="img/card.png" alt="Корзина"></a>
                                    <form method="POST">
                                        <!-- добавить класс -->
                                        <input type="submit" name="out" class="btns out" value="Выход">
                                    </form>
                                <?php
                            }
                        ?>
                    </div>

                </div>
                <!-- Иконка бургерменю -->
                <div class="burger">
                    <span></span>
                </div>
            </div>
        </div>
    </header>
</body>
<script>
        document.querySelector('.burger').addEventListener('click', function() {
            this.classList.toggle('active');
            document.querySelector('.nav').classList.toggle('open');
        })
    </script>
</html>