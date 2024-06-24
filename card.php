<?php
include 'connect.php';
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
    <?php
    include "header.php";
    ?>
    <div class="container">
        <hr class="hr_menu">
        <ul class="breadcrumb">
            <li><a href="index.php">Главная</a></li>
            <li>Корзина</li>
        </ul>

        <div class="name_page">Корзина</div>
        <div class="card_block">
            <div class="card_block_left">
                <?php

                $user_id = $_SESSION['id'];
                $matchFound = false;
                $sql = "SELECT * FROM `card`";
                $result = $conn->query($sql);
                if ($result) {
                    foreach ($result as $row) {
                        if ($row['User-id'] == $user_id) {
                            $mysql = "SELECT * FROM `products`";
                            $res = $conn->query($mysql);

                            if ($res) {
                                foreach ($res as $rows) {
                                    if ($rows['Id'] == $row['Products-id']) {
                                        if (!empty($row['Price'])) {
                                            $_SESSION['cardddd'] = 0;
                                            $show_img = base64_encode($rows['Image']);
                ?>
                                            <div class="card_tovar_1">
                                                <div class="yk">
                                                    <div class="card_info">
                                                        <img class="card_img" src="data:image/jpeg;base64,<?= $show_img ?>">
                                                        <div class="card_text_info">
                                                            <p class="card_text_zaglav"><?php echo htmlspecialchars($row['Name']) ?></p>
                                                            <input type="hidden" class="original-price-input" value="<?= htmlspecialchars($row['Price']) ?>">
                                                            <div class="original-price card_text_mini">Цена за букет: <?= htmlspecialchars($row['Price']) ?> ₽ </div>
                                                            <!-- <!— <p class="card_text_mini">Цена за единицу: '. htmlspecialchars($row['Price']). </p> —> -->
                                                        </div>
                                                        <div class="quantity">
                                                            <p class="minus minus-btn">-</p>
                                                            <div class="value quantity-value">1</div>
                                                            <p class="plus plus-btn">+</p>
                                                        </div>
                                                        <div class="none total-price">Общая стоимость: <?= htmlspecialchars($row['Price']) ?></div>
                                                        <div class="delete">
                                                            <form method="POST">
                                                                <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($row['Id']); ?>">
                                                                <button name="dell_card" class="dell_card"><img src="img/delete.png" alt=""></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                <?php
                                            $matchFound == true;
                                            if ($matchFound == true) {
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
            <div class="card_block_right">
                <div class="placing_container">
                    <p class="placing_zeglav">Ваш заказ</p>
                    <!-- <div class="placing_prace">
                        <p class="placing_prace_1">Стоимость товаров(2)</p>
                        <p class="placing_prace_2">2 400 ₽</p>
                    </div> -->
                    <input type="hidden" id="totalCostInput" value="2400">
                    <div class="placing_prace">
                        <p class="placing_prace_1">Стоимость товаров</p>
                        <!-- Здесь будет отображаться итоговая стоимость -->
                        <div class="total-price placing_prace_2" id="totalCostDisplay"></div>
                    </div>

                    <form>
                        <p class="way">Способ получения заказа:</p>
                        <label class="delivery">
                            <div>
                                <input type="checkbox" name="languages">
                                Доставка
                            </div>
                            <p class="delivery_price">Бесплатно</p>
                        </label>
                        <label class="delivery_1">
                            <input type="checkbox" name="languages">
                            Самовывоз
                        </label>
                    </form>
                    <hr class="placing_line">
                    <div class="result">
                        <p class="result_text">Итого</p>
                        <p class="result_text"><?php if (!empty($row['Price'])) {
                                                    echo $row['Price'];
                                                } else  echo "0" ?> ₽</p>
                    </div>
                    <div class="placing_button">
                        <button class="placing_btn"><a href="checkout.php" class="placing_checkout">Оформить
                                заказ</a></button>
                    </div>
                    <form>
                        <div class="agreement">
                            <input type="checkbox" id="cb1" name="languages">
                            <p class="agreement_text">Оформляя заказ вы даете согласие на обработку ваших персональных
                                данных</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--  <div class="name_page add">Добавьте к цветам подарок</div>


        <div class="content_present">
            <button id="prevBtn" class="strelka"><span>&#706;</span></button>
            <?php

            // SQL-запрос для выборки всех записей из таблицы present
            $sql = "SELECT id, name, price, description, image FROM present ORDER BY id ASC LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Генерация HTML-кода для каждого подарка
                while ($row = $result->fetch_assoc()) {
                    // Преобразование mediumblob в base64 для отображения изображения
                    $image_base64 = base64_encode($row['image']);

                    echo '
        <div class="position">
            <img src="data:image/png;base64,' . $image_base64 . '" class="present_photo" alt="">
            <div class="present_text">
                <div class="present_text_price">
                    <div class="present_name_bouquet">' . $row['name'] . '</div>
                    <div class="present_price">' . $row['price'] . ' </div>
                </div>
                <div class="present_text_price">
                    <button class="present_more"> <a href="card_present.php?id=' . $row['id'] . '" class="present_a_more">ПОДРОБНЕЕ</a></button>
                    <button class="present_card">В КОРЗИНУ</button>
                </div>
            </div>
        </div>';
                }
            } else {
                echo "0 результатов";
            }

            ?>
            <button id="nextBtn" class="strelka"><span>&#707;</span></button>
        </div> -->


    </div>
    <?php
    include "footer.php";
    ?>

</body>

<script>
    // КОЛИЧЕСТВО И СТОИМОСТЬ
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.card_tovar_1');

        cards.forEach(card => {
            const minusBtn = card.querySelector('.minus-btn');
            const plusBtn = card.querySelector('.plus-btn');
            const quantityValue = card.querySelector('.quantity-value');
            const totalPriceElement = card.querySelector('.total-price');
            const originalPriceElement = card.querySelector('.original-price');
            const totalCostInput = document.getElementById('totalCostInput'); // Получаем скрытое поле ввода для общей стоимости

            let originalPriceStr = originalPriceElement.textContent.trim(); // Убираем лишние пробелы по краям
            let originalPrice = parseFloat(originalPriceStr.replace(/\D/g, '')); // Удаляем все нецифровые символы

            let quantity = parseInt(quantityValue.textContent);

            minusBtn.addEventListener('click', function() {
                if (quantity > 1) {
                    quantity--;
                    updateTotalPriceAndDisplay(quantityValue, totalPriceElement, originalPrice, totalCostInput);
                }
            });

            plusBtn.addEventListener('click', function() {
                quantity++;
                updateTotalPriceAndDisplay(quantityValue, totalPriceElement, originalPrice, totalCostInput);
            });

            function updateTotalPriceAndDisplay(quantityValue, totalPriceElement, originalPrice, totalCostInput) {
                let totalCost = originalPrice * quantity;
                let formattedTotalCost = new Intl.NumberFormat("ru", {
                    minimumFractionDigits: 0,
                    useGrouping: true
                }).format(totalCost);
                totalPriceElement.textContent = `Общая стоимость: ${formattedTotalCost} ₽`;
                quantityValue.textContent = quantity;

                // Обновляем значение в скрытом поле ввода
                totalCostInput.value = totalCost.toString();
                // Обновляем отображение стоимости
                updateTotalCostDisplay(totalCostInput, totalCostDisplay);
            }

            function updateTotalCostDisplay(totalCostInput, totalCostDisplay) {
                const totalCost = parseInt(totalCostInput.value, 10);
                totalCostDisplay.textContent = totalCost + ' ₽';
            }

            updateTotalPriceAndDisplay(quantityValue, totalPriceElement, originalPrice, totalCostInput);
        });
    });

    function updateTotalCostDisplay(totalCostInput, totalCostDisplay) {
        const totalCost = parseInt(totalCostInput.value, 10);
        totalCostDisplay.textContent = totalCost + ' ₽';
    }
</script>


<script>
    // СЛАЙДЕР ПОДАРКОВ
    document.addEventListener('DOMContentLoaded', function() {
        var slides = document.querySelectorAll('.position'); // Получаем все слайды
        var currentSlide = 0; // Переменная для хранения индекса текущего слайда
        var slideCount = slides.length; // Количество слайдов

        // Функция для переключения слайдов
        function showSlide(n) {
            slides[currentSlide].style.display = 'none'; // Скрываем текущий слайд
            currentSlide = (n + slideCount) % slideCount; // Обновляем индекс текущего слайда
            slides[currentSlide].style.display = 'block'; // Показываем новый слайд
        }

        // Добавляем обработчики событий для кнопок
        document.getElementById('prevBtn').addEventListener('click', function() {
            showSlide(currentSlide - 1);
        });

        document.getElementById('nextBtn').addEventListener('click', function() {
            showSlide(currentSlide + 1);
        });
    });
</script>

</html>


<!-- $id = $_SESSION['id_card'];
                $sql = "SELECT * FROM products WHERE Id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                } else {
                    echo "Корзина пустая.";
                } -->