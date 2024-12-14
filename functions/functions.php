<?php

// регистрация пользователя
function registration($pdo, $first_name, $last_name, $email, $age, $password_hash)
{
    $sql = 'INSERT INTO "users" (first_name, last_name, email, age, password_hash) VALUES (?, ?, ?, ?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$first_name, $last_name, $email, $age, $password_hash]);
}

// получений айди пользователя из бд
function getIdUser($pdo, $first_name, $last_name)
{
    $sql = 'SELECT id FROM "users" WHERE first_name = ? AND last_name = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$first_name, $last_name]);
    $user_id = $query->fetch(PDO::FETCH_ASSOC);
    return $user_id ? $user_id["id"] : null; // Возвращаем id, если найден пользователь
}

// получение роли по id
function getRoleUser($pdo, $id)
{
    $sql = 'SELECT role FROM "users" WHERE id = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $user_role = $query->fetch(PDO::FETCH_ASSOC);
    return $user_role ? $user_role["role"] : "user"; // Возвращаем 'user' по умолчанию, если роль не найдена
}

// получение задач по айди пользователя
function getTasksInUserId($pdo, $id, $status)
{
    $sql = "SELECT * FROM tasks WHERE user_id = ? AND status = ? ";
    $query = $pdo->prepare($sql);
    $query->execute([$id, $status]);
    $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}

// обновление статуса задачи с pending на completed
function updateStatusTasks($pdo, $id, $status)
{
    $sql = "UPDATE tasks SET status = ? WHERE id = ?";
    $query = $pdo->prepare($sql);
    return $query->execute([$status, $id]);
}

//получение по id tasks
function getTasksOnId($pdo, $id)
{
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $tasks = $query->fetch(PDO::FETCH_ASSOC);
    return $tasks;
}

// cоздание новой задачи
function createNewTask($pdo, $taskTitle, $taskDescription, $taskStatus, $taskPriority, $user_id)
{
    $sql = 'INSERT INTO tasks (title, description, status, priority, user_id) VALUES (?, ?, ?, ?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$taskTitle, $taskDescription, $taskStatus, $taskPriority, $user_id]);
}

// удаление таска по айди
function deleteTaskOnID($pdo, $id)
{
    $sql = 'DELETE FROM tasks WHERE id = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
}

function getPriority($pdo, $priority)
{
    $sql = "SELECT * FROM tasks WHERE priority = ? ";
    $query = $pdo->prepare($sql);
    $query->execute([$priority]);

    $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}

?>
