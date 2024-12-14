<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Мой сайт</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Главная -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Главная</a>
                </li>
                <?php if (isset($_SESSION["username"])): ?>
                    <!-- Личный кабинет -->
                    <li class="nav-item">
                        <a class="nav-link" href="user-profile/profile.php"><?= $_SESSION["username"] ?></a>
                    </li>
                    <!-- Выход -->
                    <li class="nav-item">
                        <a class="nav-link" href="auth/logout.php">Выход</a>
                    </li>
                <?php else: ?>
                    <!-- Регистрация -->
                    <li class="nav-item">
                        <a class="nav-link" href="user-view/register-view.php">Регистрация</a>
                    </li>
                    <!-- Авторизация -->
                    <li class="nav-item">
                        <a class="nav-link" href="user-view/auth-view.php">Авторизация</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

