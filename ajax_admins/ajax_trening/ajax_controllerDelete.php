<?php
session_start();
require_once __DIR__ . '/../error/err.php';
require_once __DIR__ . '/../DataBaseConnection/connect.php';
require_once __DIR__ . '/forAjaxFunctions.php';

$pdo = getPdo();
$id = $_GET['id'];

// Удаляем запись и возвращаем результат
$delete_result = delete_video($pdo, $id);

// Если удаление прошло успешно
if ($delete_result) {
    echo json_encode(['success' => true, 'message' => 'Видео удалено']);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка удаления']);
}

?>
