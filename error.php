<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Она хочет цветы</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/icon.png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container">
        <hr class="hr_menu">
        <div class="error_content">
            <div class="error_text">
                <p class="error">404</p>
                <p class="error_glav_text">Страница не найдена</p>
                <p class="error_mini_text">Возможно, был введен некорректный адрес или страница была удалена</p>
                <div><button class="error_catalog"><a a href="katalog.php" class="error_catalog_a">Посмотреть каталог</a></button></div>
            </div>
            <div class="error_fon">
                <img src="img/error_fon.png" alt="">
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>