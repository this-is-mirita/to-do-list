<?php
session_start();
require_once __DIR__ . "/../functions/functions.php";
require_once __DIR__ . "/../dataBaseConnection/dbCon.php";

$pdo = getPdo();
$tasks = getTasksInUserId($pdo, $_SESSION["id"], "pending");
?>

<style>
    .task-item {
        border-width: 2px !important;
    }
</style>
<div class="d-flex align-items-center mt-2 gap-3 ">
    <p>Фильтры для задач</p>
</div>
<div class="d-flex align-items-center mt-1 gap-3 ">
    <div class="input-group my-4">
        <input id="search_checkbox" type="text" class="form-control" placeholder="Поиск задач..." aria-label="Search"
               aria-describedby="button-addon2">
        <button class="btn btn-success" type="button" id="button-addon2">
            <i class="bi bi-search"></i>
        </button>
    </div>
    <div id="low" class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="low"
               data-priority="low">
        <label class="form-check-label" for="low-">Low</label>
    </div>
    <div id="medium" class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="medium"
               data-priority="medium">
        <label class="form-check-label" for="medium-">Medium</label>
    </div>
    <div id="high" class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="high"
               data-priority="high">
        <label class="form-check-label" for="high-">High</label>
    </div>
</div>
<div id="mainContainer">
    <?php if ($tasks): ?>
        <?php foreach ($tasks as $oneTask): ?>
            <?php
            $borderColorOnTasks = match ($oneTask["priority"]) {
                "low" => "border-success",
                "medium" => "border-warning",
                "high" => "border-danger",
                default => "",
            };
            ?>
            <div id="containerAllTasks"
                 class="task-item d-flex flex-column <?= $borderColorOnTasks ?> border p-4 mt-3 rounded shadow-sm"
                 data-id="<?= $oneTask["id"] ?>">

                <!-- Название задачи -->
                <div class="task-title mb-2">
                    <strong class="d-block">Название задачи:</strong>
                    <h5 class="mb-0"><?= $oneTask["title"] ?></h5>
                </div>

                <!-- Содержание задачи -->
                <div class="task-description mb-2">
                    <strong class="d-block">Содержание задачи:</strong>
                    <?php if (strlen($oneTask["description"]) > 100): ?>
                        <p class="mb-2 text-truncate" style="max-width: 750px;">
                            <?= mb_strimwidth($oneTask["description"], 0, 100, "...") ?>
                        </p>
                        <a class="text-decoration-underline text-primary" type="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseDescription-<?= $oneTask["id"] ?>" aria-expanded="false"
                           aria-controls="collapseDescription-<?= $oneTask["id"] ?>">
                            Показать полный текст задачи
                        </a>
                        <div class="collapse mt-2" id="collapseDescription-<?= $oneTask["id"] ?>">
                            <div class="card card-body">
                                <?= $oneTask["description"] ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="mb-2"><?= $oneTask["description"] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Дополнительная информация -->
                <div class="task-info mb-3">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-muted"><strong>Статус:</strong> <?= ucfirst($oneTask["status"]) ?></p>
                        <p class="mb-0 text-muted"><strong>Приоритет:</strong> <?= ucfirst($oneTask["priority"]) ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-muted">
                            <strong>Создано:</strong> <?= substr($oneTask["created_at"], 0, 10) ?>
                        </p>
                        <p class="mb-0 text-muted">
                            <strong>Обновлено:</strong> <?= substr($oneTask["updated_at"], 0, 10) ?>
                        </p>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" class="form-check-input form-check-input-end-tasks"
                               data-id="<?= $oneTask["id"] ?>"
                               id="task-<?= $oneTask["id"] ?>"/> Завершить задачу
                    </div>
                </div>

                <!-- Действия -->
                <div class="task-actions d-flex justify-content-end">
                    <a class="btn btn-sm btn-warning me-2" title="Редактировать"
                       href="list/singlePageUpdateTasks.php?tasks=<?= $oneTask["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button data-id="<?= $oneTask["id"] ?>" id="deleted_task-<?= $oneTask["id"] ?>"
                            class="btn btn-sm btn-danger" title="Удалить">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <strong>Название задачи</strong>
    <?php endif; ?>
</div>
<script src="list/pages.js"></script>


