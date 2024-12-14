<?php
session_start();
require_once __DIR__ . '/../error/err.php';
require_once __DIR__ . '/../DataBaseConnection/connect.php';
require_once __DIR__ . '/forAjaxFunctions.php';

$pdo = getPdo();

$table = get_video($pdo); // функция должна возвращать массив

// Если ничего не найдено, возвращаем пустой массив
if (empty($table)) {
    echo json_encode([]);
    exit;
}

header('Content-Type: application/json');
echo json_encode($table);
?>
