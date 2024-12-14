<?php
require_once __DIR__ . '/../error/err.php';
require_once __DIR__ . '/../DataBaseConnection/connect.php';

function querys_functions($pdo, $tableName) {
    // Создание SQL-запроса с использованием параметра
    // В данном случае нужно использовать правильный синтаксис для вставки имени таблицы
    $sql = "SELECT * FROM $tableName ";

    // Выполнение запроса
    $query = $pdo->query($sql);

    // Извлечение всех результатов
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function update_tableComments($pdo, $id, $tableName, $title, $comments) {
    // Подготовка безопасного SQL-запроса с позиционными плейсхолдерами
    $sql = "UPDATE $tableName SET title = ?, comment = ? WHERE id = ?";

    // Подготовка запроса
    $stmt = $pdo->prepare($sql);

    // Выполнение запроса с массивом параметров
    return $stmt->execute([$title, $comments, $id]);
}