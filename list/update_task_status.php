<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . "/../functions/functions.php";
require_once __DIR__ . "/../dataBaseConnection/dbCon.php";
$pdo = getPdo();
// Получаем параметры из POST-запроса
$id = $_POST["id"];
$status = $_POST["status"];

updateStatusTasks($pdo, $id, $status);
echo json_encode(["success" => true, "message" => "Задача обновлена"]);
