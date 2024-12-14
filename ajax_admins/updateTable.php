<?php
session_start();
require_once __DIR__ . '/../error/err.php';
require_once __DIR__ . '/../DataBaseConnection/connect.php';
require_once __DIR__ . '/../ajax_admins/querys_functions.php';

$pdo = getPdo();

$id = $_POST['id'];
$title = $_POST['title'];
$comments = $_POST['comments'];

update_tableComments($pdo, $id, 'comments', $title, $comments);
echo json_encode(['rowId' => $id]); // отправляем id обновленной записи