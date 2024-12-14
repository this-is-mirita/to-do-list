<?php
session_start();
require_once __DIR__ . '/../error/err.php';
require_once __DIR__ . '/../DataBaseConnection/connect.php';
require_once __DIR__ . '/../ajax_admins/querys_functions.php';

header('Content-Type: application/json'); // Указываем, что возвращаем JSON

if (!isset($_POST['table_select'])) {
    echo json_encode(['error' => 'Не выбрана таблица']);
    exit;
}

$tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['table_select']); // Фильтрация имени таблицы

try {
    $pdo = getPdo();
    $data = querys_functions($pdo, $tableName);

    if (empty($data)) {
        echo json_encode(['error' => 'Нет данных']);
    } else {
        echo json_encode($data); // Возвращаем только данные
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}