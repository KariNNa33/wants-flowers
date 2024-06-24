<?php
include 'connect.php';
?>
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
            <li>Авторизация</li>
        </ul>

        <div class="name_page">Авторизация</div>
        <?php
        if (isset($_POST['tema'])) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // Проверка на заполнение полей
            if (empty($email) || empty($password)) {
                echo '<div class="notification">Заполните все поля</div>';
            } else {
                // Поиск пользователя по email
                $query = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['id'] = $row['id'];
                        header("Location: index.php");
                        echo '<div class=notification">Успешный вход, Добро пожаловать </div>' . $row['email'];
                        exit;
                    } else {
                        echo '<div class="notification">Неверный пароль</div>';
                    }
                } else {
                    echo '<div class="notification">Пользователь с таким email не найден</div>';
                }
            }
        }
        mysqli_close($conn);
        ?>
        <br>
        <div class="reg_login">
            <div class="notification"></div>
            <div class="cont_reg">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input class="name reg" type="email" name="email" placeholder="Email"><br>
                    <input class="name reg" type="password" name="password" placeholder="Пароль"><br>
                    <input type="submit" name="tema" value="Войти" class="send reg_btn">
                </form>
                <div class="buttons-container">
                    <p>Ещё не разеристрировались?</p>
                    <button onclick="location.href='register.php'" class="send login_btn">Зарегистрироваться</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>