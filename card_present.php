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
        require_once 'connect.php';

        $id = $_GET['id'];
        $sql = "SELECT name, description, price, image FROM present WHERE ID =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        $stmt->close();
        $conn->close();
        ?>

        <!-- HTML-код -->
        <div class="cart_present">
            <div class="img_cart_present">
                <img class="image_card_present" src="data:image/jpeg;base64,<?= base64_encode($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="info_cart_present">
                <div class="glavtext_cart_present"><?= htmlspecialchars($product['name']) ?></div>
                <div class="price_cart_present">Цена: <?= htmlspecialchars($product['price']) ?></div>
                <div class="description_cart_present">
                    <div class="description_present">Описание:</div>
                    <div class="description_more"><?= nl2br(htmlspecialchars($product['description'])) ?></div>
                </div>
                <div class="btn_cart_product">
                    <button class="popular_card">В КОРЗИНУ</button>
                    <a href="#" class="a_more"><button class="more">КУПИТЬ</button></a>
                </div>
            </div>
        </div>
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