<?php
include 'connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$flower = isset($_GET['flower']) ? $_GET['flower'] : '';

// Экранируем пробелы в значении переменной $flower
$escaped_flower = addslashes($flower);

$sql = "SELECT id, Name, Price, Image FROM products ORDER BY flower DESC";
if (!empty($escaped_flower)) { // Используем экранированное значение
    $sql .= " WHERE flower = '$escaped_flower'";
}

// Для отладки выводим сформированный SQL запрос
var_dump($sql);

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

if (!empty($escaped_flower)) {
    $stmt->bind_param('s', $escaped_flower); // Используем экранированное значение
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
        echo '<div class="katalog_price">' . htmlspecialchars($row['Price']) . '</div>';
        echo '</div>';
        echo '<div class="katalog_popular_text_price">';
        echo '<a href="card_product.php?id=' . $row['id'] . '" class="a_more"><button class="more">ПОДРОБНЕЕ</button></a>';
        echo '<button class="katalog_popular_card">В КОРЗИНУ</button>';
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
    echo "No products found.";
}

$stmt->close();
$conn->close();
