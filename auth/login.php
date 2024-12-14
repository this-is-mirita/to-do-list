<?php
session_start();
require_once "../dataBaseConnection/dbCon.php"; // база данных
require_once "../functions/functions.php";
//header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем значение поля
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Подключаемся к базе данных (предполагается, что у вас есть функция getPdo() для подключения)
    $pdo = getPdo(); // Получаем объект PDO для работы с БД

    // Подготовка SQL-запроса
    $sql =
        'SELECT id, password_hash, first_name, last_name FROM "users" WHERE email = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$email]);

    // Получаем данные пользователя из базы данных
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Проверяем, если пользователь найден
    if ($user) {
        // Проверяем, совпадает ли введенный пароль с хешем в базе данных
        if (password_verify($password, $user["password_hash"])) {
            // Успешная авторизация
            session_start();
            $_SESSION["id"] = $user["id"];
            $_SESSION["username"] = $user["first_name"];
            $_SESSION["email"] = $email;

            // Перенаправляем на личный кабинет или главную страницу
            header("Location: ../index.php");
            exit();
        } else {
            // Неверный пароль
            echo "Неверный пароль";
        }
    } else {
        // Пользователь не найден
        echo "Пользователь с таким email не найден";
    }
}
?>
