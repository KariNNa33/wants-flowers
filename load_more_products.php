<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="katalog_cont">
        <div class="katalog_page">
            <div class="katalog_popylar">
                <div class="katalog_1_line">
                    <?php
                    include 'connect.php';

                    $flower = isset($_GET['flower']) ? $_GET['flower'] : '';
                    $occasion = isset($_GET['occasion']) ? $_GET['occasion'] : '';
                    $color = isset($_GET['color']) ? $_GET['color'] : '';

                    // Убираем OFFSET 9, чтобы получить последние 9 товаров
                    $sql = "SELECT id, Name, Price, Image FROM products WHERE id >= 10"; // Изменено условие WHERE
                    if (!empty($flower)) {
                        $sql .= " AND flower =?";
                    }
                    if (!empty($occasion)) {
                        $sql .= " AND occasion =?";
                    }
                    if (!empty($color)) {
                        $sql .= " AND color =?";
                    }

                    // Добавляем ORDER BY id ASC для сортировки по ID в порядке возрастания
                    // Это гарантирует, что мы выбираем букеты начиная с 10
                    $sql .= " ORDER BY id ASC";

                    // Добавляем LIMIT 9 для получения 9 товаров
                    $sql .= " LIMIT 9";

                    $stmt = $conn->prepare($sql);
                    if ($stmt === false) {
                        die('Ошибка подготовки запроса: ' . $conn->error);
                    }

                    if (!empty($flower)) {
                        $stmt->bind_param('s', $flower);
                    }
                    if (!empty($occasion)) {
                        $stmt->bind_param('s', $occasion);
                    }
                    if (!empty($color)) {
                        $stmt->bind_param('s', $color);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $rowCount = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($rowCount % 3 == 0) {
                                echo "<div class='product-row'>";
                            }
                            echo '<div class="katalog_position">';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" class="katalog_popular_photo" alt="">';
                            echo '<div class="_katalogpopular_text">';
                            echo '<div class="katalog_popular_text_price">';
                            echo '<div class="katalog_name_bouquet">' . htmlspecialchars($row['Name']) . '</div>';
                            echo '<div class="katalog_price">' . htmlspecialchars($row['Price']) . " ₽" . '</div>';
                            echo '</div>';
                            echo '<div class="katalog_popular_text_price">';
                            echo '<a href="card_product.php?id=' . $row['id'] . '" class="a_more"><button class="more">ПОДРОБНЕЕ</button></a>';
                            echo '<button class="katalog_popular_card" onclick="window.location.href=\'card.php?id=' . $row['id'] . '\'">В КОРЗИНУ</button>';
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
                        echo "Похоже, больше нет товаров для загрузки...."; // Сообщение о том, что товары не найдены
                    }

                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>