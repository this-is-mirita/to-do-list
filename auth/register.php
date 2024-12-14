<?php
session_start();
require_once "../dataBaseConnection/dbCon.php"; // база данных
require_once "../functions/functions.php";
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем значение поля
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $password = $_POST["password"];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $pdo = getPdo();
    if ($pdo) {
        registration(
            $pdo,
            $first_name,
            $last_name,
            $email,
            $age,
            $password_hash
        );

        $userId = getIdUser($pdo, $first_name, $last_name);

        if ($userId) {
            $_SESSION["id"] = $userId;
            $_SESSION["username"] = $first_name;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = getRoleUser($pdo, $_SESSION["id"]);
        }
    } else {
        echo "не работает регистрация";
    }

    $response = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "age" => $age,
        "password" => $password,
    ];

    echo json_encode($response);
}
?>
