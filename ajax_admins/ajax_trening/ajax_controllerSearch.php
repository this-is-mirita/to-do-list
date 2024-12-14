<?php
session_start();
require_once __DIR__ . '/../error/err.php';
require_once __DIR__ . '/../DataBaseConnection/connect.php';
require_once __DIR__ . '/forAjaxFunctions.php';

$pdo = getPdo();

$search_value = $_POST['search'] ?? '';
$video = search_video($pdo, $search_value); // функция search_video должна возвращать массив

// Если ничего не найдено, возвращаем пустой массив
if (empty($video)) {
    echo json_encode([]);
    exit;
}

header('Content-Type: application/json');
echo json_encode($video);
?>
