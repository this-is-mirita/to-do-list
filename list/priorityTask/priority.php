<?php
session_start();
require_once __DIR__ . "/../../functions/functions.php";
require_once __DIR__ . "/../../dataBaseConnection/dbCon.php";

$pdo = getPdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $priority = $_POST['priority'] ?? '';

    $tasks = getPriority($pdo, $priority);

    // Возвращаем задачи в формате JSON
    header('Content-Type: application/json');
    echo json_encode($tasks);
    exit;
}