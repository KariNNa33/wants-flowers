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
            <li>Каталог</li>
        </ul>

        <div class="katalog_cont">
            <div class="filter">
                <p class="filter_1">Фильтр</p>
                <div class="eh">
                    <div class="filter_accordion">
                        <form action="katalog.php" method="get" class="filter_details">
                            <div class="filter_select">
                                <label for="Flower" class="filter_option">Цветок</label>
                                <select class="filter_details" name="Flower" id="Flower">
                                    <option class="underline-text" value="">Все</option>
                                    <option class="underline-text" value="Розы">Розы</option>
                                    <option class="underline-text" value="Тюльпаны">Тюльпаны</option>
                                    <option class="underline-text" value="Гипсофилы">Гипсофилы</option>
                                    <option class="underline-text" value="Хризантемы">Хризантемы</option>
                                    <option class="underline-text" value="Гвоздики">Гвоздики</option>
                                    <option class="underline-text" value="Ромашки">Ромашки</option>
                                    <option class="underline-text" value="Диантусы">Диантусы</option>
                                </select>
                            </div>
                            <div class="filter_select">
                                <label for="Occasion" class="filter_option">Повод</label>
                                <select class="filter_details" name="Occasion" id="Occasion">
                                    <option class="underline-text" value="">Все</option>
                                    <option class="underline-text" value="День рождение">День рождение</option>
                                    <option class="underline-text" value="8 марта">8 марта</option>
                                    <option class="underline-text" value="14 февраля">14 февраля</option>
                                </select>
                            </div>
                            <div class="filter_select">
                                <label for="Color" class="filter_option">Цвет</label>
                                <select class="filter_details" name="Color" id="Color">
                                    <option class="underline-text" value="">Все</option>
                                    <option class="underline-text" value="Розовый">Розовый</option>
                                    <option class="underline-text" value="Белый">Белый</option>
                                    <option class="underline-text" value="Голубой">Голубой</option>
                                    <option class="underline-text" value="Красный">Красный</option>
                                    <option class="underline-text" value="Желтый">Желтый</option>
                                    <option class="underline-text" value="Фиолетовый">Фиолетовый</option>
                                </select>
                            </div>
                            <input type="submit" value="Фильтровать" class="filter_btn">
                        </form>
                    </div>
                </div>
            </div>

            <div class="katalog_page">
                <div class="katalog_popylar">
                    <p class="katalog_glav_text">Каталог</p>
                    <div class="katalog_1_line">
                        <?php
                        $Flower = isset($_GET['Flower']) ? $_GET['Flower'] : '';
                        $Occasion = isset($_GET['Occasion']) ? $_GET['Occasion'] : '';
                        $Color = isset($_GET['Color']) ? $_GET['Color'] : '';

                        // Формируем SQL-запрос с учетом фильтрации
                        $sql = "SELECT * FROM products";
                        if (!empty($Flower)) {
                            $sql .= " WHERE Flower =?";
                        }
                        if (!empty($Occasion)) {
                            $sql .= " WHERE Occasion =?";
                        }
                        if (!empty($Color)) {
                            $sql .= " WHERE Color =?";
                        }

                        // Сортировка по ID в порядке возрастания (по умолчанию)
                        $sql .= " ORDER BY id ASC";

                        // Выбор первых 9 товаров
                        $sql .= " LIMIT 9";

                        $stmt = $conn->prepare($sql);
                        if ($stmt === false) {
                            die('Ошибка подготовки запроса: ' . $conn->error);
                        }

                        // Привязываем параметры, если они используются в запросе
                        if (!empty($Flower)) {
                            $stmt->bind_param('s', $Flower);
                        }
                        if (!empty($Occasion)) {
                            $stmt->bind_param('s', $Occasion);
                        }
                        if (!empty($Color)) {
                            $stmt->bind_param('s', $Color);
                        }

                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $rowCount = 0;
                            while ($row = $result->fetch_assoc()) {
                                if ($rowCount % 3 == 0) {
                                    echo "<div class='product-row'>";
                                }
                                echo '<div class="position_2">';
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" class="katalog_popular_photo" alt="">';
                                echo '<div class="katalog_popular_text">';
                                echo '<div class="katalog_popular_text_price">';
                                echo '<div class="katalog_name_bouquet">' . htmlspecialchars($row['Name']) . '</div>';
                                echo '<div class="katalog_price">' . htmlspecialchars($row['Price']) . " ₽" . '</div>';
                                echo '</div>';
                                echo '<div class="katalog_popular_text_price">';
                                echo '<a href="card_product.php?id=' . $row['Id'] . '" class="katalog_a_more"><button class="katalog_more">ПОДРОБНЕЕ</button></a>';
                        ?>
                                <form method="POST" class="btn_cart_product">
                                    <input type="hidden" type="text" name="id" value="<?php echo $row['Id'] ?>">
                                    <input type="submit" class="katalog_popular_card" name="add_to_cart" value="В КОРЗИНУ">
                                </form>
                        <?php
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';

                                $rowCount++;
                                if ($rowCount % 3 == 0) {
                                    echo '</div>';
                                }
                            }
                            if ($rowCount % 3 != 0) {
                                echo '</div>';
                            }
                        } else {
                            echo "По вашему запросу ничего не найдено.";
                        }
                        echo $_SESSION['id'];
                        ?>
                    </div>
                </div>
                <div id="productsContainer"></div> <!-- Новый контейнер для товаров -->
                <div class="katalog_more_position_btn">
                    <button id="loadMoreButton" class="katalog_more_position">СМОТРЕТЬ ЕЩЁ</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>

<script>
    document.getElementById('loadMoreButton').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        var offset = parseInt(localStorage.getItem('offset')) || 0;
        xhr.open('GET', 'load_more_products.php?offset=' + offset);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var newProducts = xhr.responseText.trim();
                if (newProducts) {
                    var container = document.getElementById('productsContainer');
                    var productBlock = document.createElement('div'); // Создаем новый блок товаров
                    productBlock.innerHTML = newProducts; // Добавляем HTML блок товаров из ответа сервера
                    container.appendChild(productBlock); // Добавляем блок в контейнер
                    offset += 9;
                    localStorage.setItem('offset', offset); // Обновляем смещение в localStorage
                    this.style.display = 'none'; // Скрываем кнопку, если больше нет товаров
                } else {
                    alert("Похоже, больше нет товаров для загрузки.");
                }
            }
        };
        xhr.send();
    });
</script>