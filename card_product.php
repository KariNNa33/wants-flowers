<!DOCTYPE html>
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
        <ul class="breadcrumb">
            <li><a href="index.php">Главная</a></li>
            <li>О товаре</li>
        </ul>


        <?php
        include 'connect.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE Id = $id";
        $result = $conn->query($sql);
        foreach ($result as $row) {
        ?>
            <div class="cart_product">
                <div class="img_cart_product">
                    <img class="image_card" src="data:image/jpeg;base64,<?= base64_encode($row['Image']); ?>" alt="<?= htmlspecialchars($row['Name']); ?>">
                    <div class="img_cart_product_two">
                        <img class="image_card_2" src="data:image/jpeg;base64,<?= base64_encode($row['AdditionalImage2']); ?>" alt="<?= htmlspecialchars($row['Name']); ?>">
                        <img class="image_card_2" src="data:image/jpeg;base64,<?= base64_encode($row['AdditionalImage3']); ?>" alt="<?= htmlspecialchars($row['Name']); ?>">
                    </div>
                </div>
                <div class="info_cart_product">
                    <div class="glavtext_cart_product"><?= htmlspecialchars($row['Name']); ?></div>
                    <div class="price_cart_product">Цена: <?= htmlspecialchars($row['Price']); ?></div>
                    <div class="description_cart_product">
                        <div class="description">Описание:</div>
                        <div class="description_more"><?= nl2br(htmlspecialchars($row['Description'])); ?></div>
                    </div>
                    <form method="POST" action="card.php" class="btn_cart_product">
                        <input type="hidden" type="text" name="id" value="<?php echo $row['Id']; ?>">
                        <input type="hidden" name="Name" id="Name" value="<?php echo $row['Name']; ?>">
                        <input type="hidden" name="Price" value="<?php echo $row['Price']; ?>">
                        <input type="hidden" name="Image" id="Image" value="<?php echo base64_encode($row['Image']); ?>">
                        <input type="submit" class="popular_card" name="add_to_cart" value="В КОРЗИНУ">
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- <div class="cart_product">
            <div class="img_cart_product">
                <img src="img/cart_product.png" alt="Гипсофилы">
                <div class="img_cart_product_two">
                    <img src="img/cart_product2.png" alt="Гипсофилы">
                    <img src="img/cart_product3.png" alt="Гипсофилы">
                </div>
            </div>
            <div class="info_cart_product">
                <div class="glavtext_cart_product">Букет из гипсофилы</div>
                <div class="price_cart_product">Цена: 1 150 ₽</div>
                <div class="btn_cart_product">
                    <button class="popular_card">В КОРЗИНУ</button>
                    <a href="#" class="a_more"><button class="more">КУПИТЬ</button></a>
                </div>
                <div class="description_cart_product">
                    <div class="description">Описание:</div>
                    <div class="description_more">Гипсофила – это удивительный цветок, который символизирует чистоту,
                        искренность и нежность. Голубой и розовый оттенки добавляют букету загадочности и глубины, делая
                        его еще более привлекательным. Бело-розовая упаковка подчеркивает нежность и изящество букета, а
                        также придает ему особый шарм и изысканность.</div>
                </div>
            </div>
        </div> -->
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>