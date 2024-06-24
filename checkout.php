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
    <?php
    include "header.php";
    ?>
    <div class="container">
        <hr class="hr_menu">
        <ul class="breadcrumb">
            <li><a href="index.php">Главная</a></li>
            <li><a href="card.php">Корзина</a></li>
            <li>Оформление заказа</li>
        </ul>
        <div class="name_page">Оформление заказа</div>

        <div class="checkout">
            <div class="block_checkout">
                <p class="name_checkout">Ваш заказ: </p>

                <?php
                $sql = "SELECT Id, Name, Price, Image, Count FROM card"; // Убедитесь, что все необходимые поля указаны
                $result = $conn->query($sql);
                $totalCost = 0;
                // Генерация HTML-кода
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="offer-card">';
                        echo '<div class="imaggg_checkout">';
                        echo '<img src="data:image/jpeg;base64,' . $row['Image'] . '" class="bl-ico">';
                        echo '</div>';
                        echo '<div class="card-text-container">';
                        echo '<p class="card-title">' . htmlspecialchars($row["Name"]) . '</p>'; // Использование htmlspecialchars для предотвращения XSS-атак

                        $totalCost += $row["Price"];

                        echo '<p class="card-title">' . htmlspecialchars($row["Count"]) . ' шт</p>';
                        echo '</div>';
                        echo '<p class="price-card">' . htmlspecialchars($row["Price"]) . ' ₽</p>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
               
                ?>
                <hr class="checkout_line">
                <form method="POST">
                    <div class="checkout_data">
                        <input type="text" name="Name" class="offer-input check" placeholder="*Имя" required>
                        <input type="text" name="Phone" class="offer-input check" placeholder="*Номер телефона" required>
                    </div>
                    <div class="checkout_delivery_block">
                        <p class="delivery_chekc">*Способ получения заказа:</p>
                        <label class="delivery_chekc">
                            <div>
                                <input type="checkbox" name="languages">
                                Доставка (бесплатно)
                            </div>
                        </label>
                        <label class="delivery_chekc">
                            <input type="checkbox" name="languages">
                            Самовывоз (заберем цветы в магазине)
                        </label>
                    </div>
                    <div class="checkout_data">
                        <p class="date">Адрес доставки (если нужна)</p>
                        <div class="input-container-delivery">
                            <input type="text" name="Fio" class="offer-input check" placeholder="ФИО получателя">
                            <input type="text" name="Street" class="offer-input check" placeholder="Улица">
                        </div>
                        <div class="input-container-adress">
                            <input type="text" name="House" class="offer-input-adress check" placeholder="Дом">
                            <input type="text" name="Apartment" class="offer-input-adress check" placeholder="Квартира / офис">
                        </div>
                        <div class="input-container">
                            <input type="text" name="Comment" class="offer-input-ps check" placeholder="Комментарий к заказу">
                        </div>
                    </div>
                    <div class="checkout_data">
                        <p class="date">*Дата и время получения заказа</p>
                        <div>
                            <input type="date" name="Date" class="input_date" required>
                            <input type="time" name="Time" class="input_time" required>
                        </div>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" class="delivery">
                        <p class="acess-text">Я согласен с политикой конфиденциальности</p>
                    </div>
                    <div class="finish-price-itog-container">
                        <?php
                        echo '<p class="finish-price-itog-text">Итого: '. $totalCost. ' ₽</p>';
                        ?>
                    </div>
                    <div class="finish-btn-container">
                        <input type="submit" class="btn-finish btn-finish_check" name="order_btn" value="Заказать">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['Name'] ?? '';
        $phone = $_POST['Phone'] ?? '';
        $deliveryMethod = isset($_POST['languages']) ? 'Доставка' : 'Самовывоз';
        $fioReceiver = $_POST['Fio'] ?? '';
        $street = $_POST['Street'] ?? '';
        $house = $_POST['House'] ?? '';
        $apartment = $_POST['Apartment'] ?? '';
        $comment = $_POST['Comment'] ?? '';
        $date = $_POST['Date'] ?? '';
        $time = $_POST['Time'] ?? '';

        $sql = "INSERT INTO orders (name, phone, delivery_method, fio_receiver, street, house, apartment, comment, date, time) VALUES (?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $name, $phone, $deliveryMethod, $fioReceiver, $street, $house, $apartment, $comment, $date, $time);

        if ($stmt->execute()) {
            echo '<div class="success-message">';
            echo "Ваш заказ принят!";
            echo '</div>';
        } else {
            echo '<div class="success-message">';
            echo "Ошибка: " . $sql . "<br>";
            echo htmlspecialchars($conn->error);
            echo '</div>';
        }
        $stmt->close();
        $conn->close();
    }
    ?>
    <?php
    include "footer.php";
    ?>

</body>

</html>