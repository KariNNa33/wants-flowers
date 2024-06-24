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
            <li>Регистрация</li>
        </ul>

        <div class="name_page">Регистрация</div>
        <?php
        // Проверка, была ли отправлена форма
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'connect.php';

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Проверка наличия всех полей
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                echo '<div class="notification">Заполните все поля</div>';
            } else {
                // Проверка, совпадают ли пароль и подтверждение пароля
                if ($password != $confirm_password) {
                    echo '<div class="notification">Пароль и подтверждение пароля не совпадают</div>';
                } else {
                    // Проверка уникальности email в базе данных
                    $check_email_query = "SELECT * FROM users WHERE email='$email'";
                    $result = $conn->query($check_email_query);

                    if ($result->num_rows > 0) {
                        echo '<div class="notification">Пользователь с таким email уже зарегистрирован</div>';
                    } else {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

                        if ($conn->query($insert_query) === TRUE) {
                            echo '<div class="notification">Регистрация успешна!</div>';

                            header("Location: login.php");
                            exit; 
                        } else {
                            echo "Ошибка: " . $insert_query . "<br>" . $conn->error;
                        }
                    }
                }
            }

            $conn->close();
        }
        ?>
        <br>
        <div class="reg_login">
            <div class="cont_reg">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input class="name reg" type="text" name="username" placeholder="Имя"><br>
                    <input class="name reg" type="email" name="email" placeholder="Email"><br>
                    <input class="name reg" type="password" name="password" placeholder="Пароль"><br>
                    <input class="name reg" type="password" name="confirm_password" placeholder="Подтвердите пароль"><br>
                    <input type="submit" value="Зарегистрироваться" class="send reg_btn">
                </form>
                <div class="buttons-container">
                    <p>У вас уже есть аккаунт? </p>
                    <button onclick="location.href='login.php'" class="send login_btn">Войти</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>