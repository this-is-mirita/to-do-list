<?php
session_start();
require_once __DIR__ . "/../../functions/functions.php";
require_once __DIR__ . "/../../dataBaseConnection/dbCon.php";

$pdo = getPdo();

$user_id = $_SESSION["id"];

$taskTitle = $_POST['taskTitle'];
$taskDescription = $_POST['taskDescription'];
$taskStatus = $_POST['taskStatus'];
$taskPriority = $_POST['taskPriority'];

createNewTask($pdo, $taskTitle, $taskDescription, $taskStatus, $taskPriority, $user_id);
