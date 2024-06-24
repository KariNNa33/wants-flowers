<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Она хочет цветы</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/icon.png">
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <div class="fon"></div>
    <?php
    include "header.php";
    ?>

    <div class="container">
        <div class="offer">
            <p class="offer_text_1">ТВОЙ БУКЕТ ВСЁ СКАЖЕТ ЗА ТЕБЯ</p>
            <p class="offer_text_2">Радуйте близких по любому поводу</p>
        </div>
        <div class="btn_1"><a href="katalog.php"><button class="btn_catalog">В КАТАЛОГ</button></a></div>


        <div class="advantages">
            <div class="experience">
                <img src="img/experience.png" class="advantages_img" alt="Стаж">
                <p class="advantages_text">Стаж работы наших флористов более 10 лет
            </div>
            <div class="experience">
                <img src="img/photo.png" class="advantages_img" alt="Фото">
                <p class="advantages_text">Перед отправкой всегда отправляем фото букета
            </div>
            <div class="experience">
                <img src="img/instructions.png" class="advantages_img" alt="Инструкция">
                <p class="advantages_text">Дарим инструкцию по уходу за букетом
            </div>
        </div>
    </div>
    <div class="discount">
        <div class="container">
            <div class="re">
                <div class="discount_info">
                    <p class="discount_text">Подпишись на нашу группу в ВК и получи</p>
                    <div class="dis_img"><img src="img/ten.png" class="discount_img" alt="скидка 10%"></div>
                    <p class="discount_text">скидки на первый заказ</p>
                </div>

                <div class="btn_discount">
                    <button class="discount_btn"><a class="discount_a" href="https://vk.com/fiowers32">ПОДПИСАТЬСЯ</a></button>
                </div>
            </div>
        </div>
    </div>

    <h1 class="heading">ПОПУЛЯРНОЕ</h1>
    <div class="container">
        <div class="container_popular">

            <?php
            include 'connect.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, Name, Price, Image FROM products ORDER BY Price DESC LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="position">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" class="popular_photo" alt="">';
                    echo '<div class="popular_text">';
                    echo '<div class="popular_text_price">';
                    echo '<div class="name_bouquet">' . htmlspecialchars($row['Name']) . '</div>';
                    echo '<div class="price">' . htmlspecialchars($row['Price']) . " ₽" . '</div>';
                    echo '</div>';
                    echo '<div class="popular_text_price">';
                    echo '<a href="card_product.php?id=' . $row['id'] . '" class="a_more"><button class="more">ПОДРОБНЕЕ</button></a>';
                    ?>
                    <form method="POST" class="btn_cart_product">
                    <input type="hidden" type = "text" name="id" value="<?php echo $row['id'] ?>">
                        <input type="submit" class="popular_card" name="add_to_cart" value="В КОРЗИНУ">
                    </form>
                    <?php
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No products found.";
            }
            $conn->close();
            ?>
        </div>
    </div>


    <div class="fon_2">
        <h1 class="heading_feedback">Не нашли подходящий букет?</h1>
        <p class="text_feedback">Оставьте свой номер телефона и наш менеджер свяжется с Вами в течении 15 минут.</p>
        <form id="feedbackForm" action="" method="post" class="feedbackForm">
            <div class="form_feedback">
                <input type="text" name="name" placeholder="Имя" class="name" required><br>
                <input type="text" name="phone" placeholder="Номер телефона" class="name" required><br>
                <div class="text_feedback_agreement">
                    <input type="checkbox" id="cb1" name="agreement" class="checkbox_feedback" required>
                    <label for="cb1" class="text_feedback_checkbox">Оформляя заказ вы даете согласие на обработку ваших персональных данных</label>
                </div><br>
                <input type="submit" value="Отправить" class="send">
            </div>
        </form>
    </div>


    <h1 class="heading" id="about">О НАС </h1>
    <div class="container">
        <div class="about_block">
            <div class="info_about about_1">
                <div class="about_text">Мы - непревзойденная команда профессиональных флористов, стремящихся принести
                    утонченную эстетику и невероятный восторг в вашу жизнь. Наше основное призвание - создавать
                    великолепные цветочные ансамбли, которые являются воплощением изысканности, любви и заботы.<br>
                    Мы полностью погружены в мир цветов и постоянно следим за самыми свежими и прекрасными экземплярами.
                    Каждый букет, созданный нашей командой, становится подлинным произведением искусства, таким
                    уникальным и индивидуальным, как сам получатель. Мы вдохновляемся естественной красотой и
                    уникальностью каждого цветка, чтобы создать для вас незабываемые впечатления.</div>
                <img src="img/about1.png" class="about_img" alt="">
            </div>
            <div class="info_about about_2">
                <img src="img/about2.png" class="about_img_2" alt="">
                <div class="about_text">Наш ассортимент включает широкий спектр разнообразных цветов и оттенков. Мы
                    отбираем только самые прекрасные и редкие экземпляры, чтобы удовлетворить даже самых взыскательных
                    клиентов. У нас вы найдете как классические розы и хризантемы, так и экзотические орхидеи и ландыши.
                    Каждый цветок, который мы предлагаем, проникнут нежностью и ароматом, подаривший вашему пространству
                    утонченность и уникальность.<br>
                    Обращаясь к нам, вы можете быть уверены, что ваш заказ будет выполнен с максимальной тщательностью и
                    глубоким пониманием вашего вкуса. Мы готовы принести в вашу жизнь намного больше, чем просто цветы -
                    мы создаем незабываемую атмосферу и делаем ваш мир ярче и красивее. Закажите наши цветочные
                    композиции сейчас и ощутите, как радость и красота воплощаются в каждом цветке. </div>
            </div>
        </div>
    </div>
    <h1 class="heading">ПРОИЗВОДСТВО</h1>
    <div class="container">
    <div class="production_cont">
            <div class="production_block">
                <a href="https://vk.com/clips/fiowers32?z=clip-55827550_456239046"><img src="img/video_1.png" class="video_1" alt=""></a>
                <img src="img/production_1.png" class="production_block_1" alt="">
            </div>
            <div class="production_block">
                <a href="https://vk.com/fiowers32?z=clip-55827550_456239049"><img src="img/video_2.png" class="video_2" alt=""></a>
                <div class="production_block_two">
                    <img src="img/production_2.png" class="production_block__2" alt="">
                    <img src="img/production_3.png" class="production_block__2" alt="">
                </div>
            </div>
        </div>

    </div>



    <div class="question_response">
        <h1 class="heading">ВОПРОСЫ И ОТВЕТЫ</h1>
        <div class="container">
            <div class="block_accordion">
                <img src="img/question.png" class="question_img" alt="">
                <div class="accordion">
                    <details>
                        <summary class="question_glav_text">Если я знаю только имя и телефон/соц сеть получателя, то вы
                            сможете
                            доставить цветы?</summary>
                        <p class="question_mini_text">Да, конечно. Мы сами свяжемся с получателем и уточним к какому
                            времени
                            удобно получить доставку и по какому адресу. Мы говорим, что на Ваше имя оформлена доставка,
                            не говорим что это цветы, так что эффект сюрприза все рано остаётся.</p>
                    </details>
                    <details>
                        <summary class="question_glav_text">Если я оформляю заказ, но живу в другом городе. Как мне
                            убедится,
                            что вы сделали именно тот букет, что я заказал и доставили его?</summary>
                        <p class="question_mini_text">Как мы получим заказ с сайта мы с вами свяжемся и уточним все
                            детали.
                            Перед самой доставкой пришлем вам фото готового заказа в Вотсапе или телеграмм и сообщим как
                            все доставим. Поэтому вы все увидите.</p>
                    </details>
                    <details open>
                        <summary class="question_glav_text">Какой график работы?</summary>
                        <p class="question_mini_text">Мы работаем с 8:00 до 20:00 ежедневно.</p>
                    </details>
                    <details>
                        <summary class="question_glav_text">Вы доставляете только по городу?</summary>
                        <p class="question_mini_text">Да, доставка осуществляется только по городу, стоимость 350 рублей
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>

<script src="accordion.js"></script>
<script>
    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы

        const nameInput = document.querySelector('.name');
        const phoneInput = document.querySelector('.phone');
        const checkbox = document.querySelector('.checkbox_feedback');

        // Проверяем, заполнены ли все обязательные поля
        if (!nameInput.value || !phoneInput.value || !checkbox.checked) {
            alert('Пожалуйста, заполните все обязательные поля.');
            return false; // Останавливаем выполнение скрипта
        }

        alert('Ваш заказ принят, ожидайте.'); // Отображаем уведомление
    });
</script>

<!-- // ВОСПРОИЗВЕДЕНИЕ ВИДЕО -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>