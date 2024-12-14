<?php
session_start();
require_once __DIR__ . "/../functions/functions.php";
require_once __DIR__ . "/../dataBaseConnection/dbCon.php";

$pdo = getPdo();

$tasks = $_GET['tasks'];

$single_tasks = getTasksOnId($pdo, $tasks);

echo "<pre>";
var_dump($single_tasks['id']);
echo "</pre>";
//$id = $_GET['id'] ?? null;
//$title = $_GET['title'] ?? '';
//$description = $_GET['description'] ?? '';
//$priority = $_GET['priority'] ?? '';
//$status = $_GET['status'] ?? '';
?>
<div class="container my-5">
    <?php foreach ($single_tasks as $oneTask) : ?>
        <?php
        echo "<pre>";
        var_dump($oneTask);
        echo "</pre>";
        ?>
        <div class="task-item card mb-4 shadow-sm" data-id="<?= $oneTask['id'] ?>">
            <div class="card-body">
                <h3><?= $oneTask['title'] ?></h3>
                <p><?= htmlspecialchars($oneTask['description'] ?? '') ?></p>
                <p><strong>Статус:</strong> <?= ucfirst($oneTask['status'] ?? '') ?></p>
                <p><strong>Приоритет:</strong> <?= ucfirst($oneTask['priority'] ?? '') ?></p>
                <p><strong>Создано:</strong> <?= substr($oneTask['created_at'] ?? '', 0, 10) ?></p>
                <p><strong>Обновлено:</strong> <?= substr($oneTask['updated_at'] ?? '', 0, 10) ?></p>

            </div>
        </div>
    <?php endforeach; ?>
</div>
