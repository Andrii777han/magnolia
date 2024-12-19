<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Maria Garden</title>
    <link rel="icon" href="7.png" type="image/png">
</head>
<body>
    <nav>
        <span class="nav1"><a href="About us.html">Про нас</a></span>
        <span class="nav"><a href="menu.html">Меню</a></span>
        <span class="nav"><a href="reservation.html">Бронювання</a></span>
        <span class="nav"><a href="reviews.html">Відгуки</a></span>
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="nav2"><a href="logout.php">Вийти</a></span>
        <?php else: ?>
            <span class="nav2"><a href="registration.html">Увійти</a></span>
        <?php endif; ?>
    </nav>
    <div class="image-container">
        <img src="2.png" alt="Зображення">
    </div>
    <div class="bottom-container">
        <div class="box">
            <img src="4.png" alt="Графік роботи">
            <div class="caption1">Пн-ПТ 10:00-22:00</div>
            <div class="caption2">ГРАФІК РОБОТИ</div>
        </div>
        <div class="box">
            <img src="5.png" alt="Адреса">
            <div class="caption1">вул. Ленкавського 43</div>
            <div class="caption2">АДРЕСА</div>
        </div>
        <div class="box">
            <img src="3.png" alt="Телефон">
            <div class="caption1">+38-099-555-4444</div>
            <div class="caption2">ТЕЛЕФОН</div>
        </div>
    </div>
</body>
</html>
