<?php
    // Подключение к базе данных
      include 'connect.php';

    // Получение данных из POST-запроса
    $name = $_POST['Name'];
    $phone = $_POST['Phone'];
    $fio = $_POST['Fio'];
    $street = $_POST['Street'];
    $house = $_POST['House'];
    $apartment = $_POST['Apartment'];
    $comment = $_POST['Comment'];
    $date = $_POST['Date'];
    $time = $_POST['Time'];

    // Подготовка SQL запроса
    $sql = "INSERT INTO checkout (Name, Phone, Fio, Street, House, Apartment, Comment, Date, Time) VALUES (?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $phone, $fio, $street, $house, $apartment, $comment, $date, $time);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    ?>