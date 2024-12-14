<?php
session_start();
require_once __DIR__ . "/../../functions/functions.php";
require_once __DIR__ . "/../../dataBaseConnection/dbCon.php";

$pdo = getPdo();

$task_id = $_POST['id'];
deleteTaskOnID($pdo, $task_id);

