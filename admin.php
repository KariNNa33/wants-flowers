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
    include "connect.php";

    // вход в адмику
    if (!isset($_SESSION['login'])) { ?>
        <?php
        if (isset($_POST['send3'])) {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                $sql = "SELECT * FROM `admin` WHERE `login` = '$login' AND `password` = '$password'";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    $_SESSION['login'] = $_POST['login'];
                    header('refresh:0');
                } else echo "<script>alert('Юзер отсутствует')</script>";
            }
        }
        ?>
        <div class="cont_admin">
            <div class="admin">
                <form method="POST" class="admin_form">
                    <a href="index.php"><img src="img\logo.png" alt="Логотип" width="200" height="200"></a>
                    <h1 class="admin_glav_text">Доступ к панели администратора</h1>
                    <div class="admin_vhod">
                        <input type="text" name="login" class="form-control" id="floatingInput" placeholder="Логин">
                    </div>
                    <div class="admin_vhod">
                        <input type="password" name="password" class="form-control" placeholder="Пароль">
                    </div>
                    <div class="admin_vhod">
                        <input class="admin_btn" type="submit" name="send3" value="Войти">
                    </div>
                </form>
            </div>
        </div>
    <?php
    }
    if (isset($_SESSION['login'])) {
    ?>
        <!-- Меню -->
        <div class="container">

            <div class="admin_menu">
                <a href="index"><img src="img\logo.png" alt="Логотип" width="150" height="150"></a>
            </div>

            <!-- форма добавления -->
            <div class="redakt_tovar">
                <div class="admin_block_tovar">
                    <p class="admin_zaglavn">Добавить товар</p>
                    <form method="POST" enctype="multipart/form-data" class="admin_form_tovar">
                        <div class="admin_pole">
                            <label class="admin_min_text">Введите название товара</label>
                            <input type="text" name="Name" class="form-tovar" placeholder="Название" required>
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text opisanie">Введите описание товара</label>
                            <input type="text" name="Description" class="form-tovar" placeholder="Описание" required>
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Введите стоимость товара</label>
                            <input type="text" name="Price" class="form-tovar" placeholder="Стоимость" required>
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Введите вид цветка</label>
                            <input type="text" name="Flower" class="form-tovar" placeholder="Вид цветка" required>
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Введите цвет товара</label>
                            <input type="text" name="Color" class="form-tovar" placeholder="Цвет" required>
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Введите праздник</label>
                            <input type="text" name="Occasion" class="form-tovar" placeholder="Праздник" required>
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Добавте фото товара</label>
                            <input type="file" name="Image" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Добавте фото товара</label>
                            <input type="file" name="AdditionalImage2" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                        <div class="admin_pole">
                            <label class="admin_min_text">Добавте фото товара</label>
                            <input type="file" name="AdditionalImage3" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                        <div class="admin_pole"><button class="admin_tovar_btn" type="submit" name="add" id="add">Добавить товар</button></div>
                    </form>
                </div>

                <!-- добавление товара -->
                <?php
                if (isset($_POST['add'])) {
                    $Name = $_POST['Name'];
                    $Description = $_POST['Description'];
                    $Price = $_POST['Price'];
                    $Flower = $_POST['Flower'];
                    $Color = $_POST['Color'];
                    $Occasion = $_POST['Occasion'];
                    if (!empty($_FILES['Image']['tmp_name']) && !empty($_FILES['AdditionalImage2']['tmp_name']) && !empty($_FILES['AdditionalImage3']['tmp_name'])) {

                        $Image = addslashes(file_get_contents($_FILES['Image']['tmp_name']));
                        $AdditionalImage2 = addslashes(file_get_contents($_FILES['AdditionalImage2']['tmp_name']));
                        $AdditionalImage3 = addslashes(file_get_contents($_FILES['AdditionalImage3']['tmp_name']));

                        $sql = "INSERT INTO `products`( `Name`, `Description`, `Price`, `Image`, `AdditionalImage2`, `AdditionalImage3`, `Flower`, `Color`, `Occasion`) VALUES ('$Name','$Description','$Price','$Image','$AdditionalImage2','$AdditionalImage3','$Flower',' $Color','$Occasion')";
                        $result = $conn->query($sql);
                        if ($result) {
                            echo "Букет добавлен";
                        } else {
                            echo "Ошибка;";
                        }
                    }
                }
                ?>

                <div class="admin_block_tovar">
                    <div class="admin_block_tovar">
                        <p class="admin_zaglavn">Удалить товар</p>
                    </div>
                    <!-- удаление товара -->
                    <?php
                    $otzov = $conn->query("SELECT * FROM `products` ORDER BY `Id`");
                    while ($comm = mysqli_fetch_assoc($otzov)) {
                    ?>
                        <div class="dell-card-body">
                            <div class="product-block_kdowe">
                                <form method="POST" class="dell-card">
                                    <div class="dell_pole">
                                        <p class="admin_min_text">Название: <?php echo ' ';
                                                                            echo htmlspecialchars($comm['Name']) . ' '; ?></p>
                                        <p class="admin_min_text">Описание: <?php echo ' ';
                                                                            echo htmlspecialchars($comm['Description']); ?></p>
                                        <p class="admin_min_text">Цена: <?php echo ' ';
                                                                        echo htmlspecialchars($comm['Price']); ?></p>

                                        <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($comm['Id']); ?>">
                                        <button class="admin_tovar_btn" type="submit" name="dell">Удалить</button>
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                        ?>

                        </div>
                </div>
                <div class="admin_block_tovar">
                    <p class="admin_zaglavn">Заказы</p>
                </div>
                <div class="admin_block_tovar">
                    <?php
                    // Предполагается, что $conn уже установлено и подключено к базе данных

                    // SQL запрос для выборки данных
                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Вывод заголовков столбцов
                        echo "<table class='table'><tr><th>Имя</th><th>Телефон</th><th>Способ получения заказа</th><th>ФИО получателя</th><th>Улица</th><th>Дом</th><th>Квартира/офис</th><th>Комментарий</th><th>Дата</th><th>Время</th><th>Действия</th></tr>";

                        // Вывод данных каждой строки с возможностью удаления
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr style='margin-bottom: 60px;'>";

                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["delivery_method"] . "</td>";
                            echo "<td>" . $row["fio_receiver"] . "</td>";
                            echo "<td>" . $row["street"] . "</td>";
                            echo "<td>" . $row["house"] . "</td>";
                            echo "<td>" . $row["apartment"] . "</td>";
                            echo "<td>" . $row["comment"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["time"] . "</td>";
                            echo "<td>
                <input type='hidden' name='review_id' value='" . htmlspecialchars($row['id']) . "'>
                <button class='admin_tovar_btn' type='submit' name='del_order'>Удалить</button>
              </td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Нет заказов";
                    }

                    if (isset($_POST['del_order'])) { // Исправлено имя на 'dell', согласно имени кнопки
                        $id = $_POST['review_id'];
                        $stmt = $conn->prepare("DELETE FROM `orders` WHERE `id` =?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        if ($stmt->affected_rows > 0) {
                            header("Location: " . $_SERVER['PHP_SELF']); // Исправлено на перенаправление на ту же страницу
                            exit();
                        } else {
                            echo "Ошибка";
                        }
                    }

                    $conn->close();
                    ?> </div>
            </div> <?php
                }
                    ?>
        </div>
        <?php if (isset($_POST['adminout'])) {
            session_destroy();
            // unset($_SESSION['login']);
            header("location:admin");
        } ?>
        <script src="bootstrap-5.3.3-dist\js\bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>

</html>