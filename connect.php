<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flowers";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['out'])) {
    session_destroy();
    header("location: index.php");
}

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    $_SESSION['id_card'] = $id;
    $user_id = $_SESSION['id'];
    $find = "SELECT * FROM `products` WHERE `id` = '$id'";
    $product = $conn->query($find);
    foreach ($product as $row) {
        $Name = $row['Name'];
        $Price = $row['Price'];
        $imggg = base64_encode($row['Image']);
        $add_product = "INSERT INTO `card` (`Name`, `Price`, `Image`, `User-id`, `Count`, `Products-id`) VALUES ('$Name', '$Price','$imggg','$user_id', 1, $id)";
        $res = $conn->query($add_product);
        if ($res) {
            header("location: card.php");
            exit();
        }
    }
}

if (isset($_POST['dell_card'])) {
    $idd = $_POST['review_id'];
    $stmt = $conn->prepare("DELETE FROM `card` WHERE `Id` =?");
    $stmt->bind_param("i", $idd);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header('refresh:0');
    }
}


// удаление товара
if (isset($_POST['dell'])) {
    $id = $_POST['review_id'];
    $stmt = $conn->prepare("DELETE FROM `products` WHERE `Id` =?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header("refresh:0");
        echo "<script>alert('Товар удален')</script>";
        exit();
    } else {
        echo "Ошибка";
    }
}

return $conn;
