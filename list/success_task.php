<?php
session_start();
require_once __DIR__ . "/../functions/functions.php";
require_once __DIR__ . "/../dataBaseConnection/dbCon.php";
//var_dump($_SESSION);

$pdo = getPdo();
// status pending/completed
$tasks = getTasksInUserId($pdo, $_SESSION["id"], "completed");
?>

<style>
    .task-item {
        border-width: 2px !important;
    }
</style>

<?php if ($tasks): ?>
    <?php foreach ($tasks as $oneTask): ?>
        <!-- Определение цвета бордюра в зависимости от приоритета -->
        <?php
        $borderColorOnTasks = "";
        switch ($oneTask["priority"]) {
            case "low":
                $borderColorOnTasks = "border-success";
                break;
            case "medium":
                $borderColorOnTasks = "border-warning";
                break;
            case "high":
                $borderColorOnTasks = "border-danger";
                break;
            default:
                $borderColorOnTasks = "";
        }
        ?>
        <!-- для ссылок -->
        <?php
        $colorLink = "";
        switch ($oneTask["priority"]) {
            case "low":
                $colorLink = "link-success";
                break;
            case "medium":
                $colorLink = "link-warning";
                break;
            case "high":
                $colorLink = "link-danger";
                break;
            default:
                $colorLink = "";
        }
        ?>
        <div id="containerAllTasks"
             class="task-item d-flex flex-column <?= $borderColorOnTasks ?> border p-4 mb-3 rounded shadow-sm"
             data-id="<?= $oneTask["id"] ?>">

            <!-- Метка выполненной задачи -->
            <div class="task-status mb-2 text-end">
                <span class="badge bg-success">Выполнено</span>
            </div>

            <!-- Название задачи -->
            <div class="task-title mb-1">
                <strong class="d-block">Название задачи:</strong>
                <strong><?= $oneTask["title"] ?></strong>
            </div>

            <!-- Содержание задачи -->
            <div class="task-description mb-1">
                <strong class="d-block">Содержание задачи:</strong>
                <?php if (strlen($oneTask["description"]) > 100): ?>
                    <p class="mb-2"><?= mb_strimwidth($oneTask["description"], 0, 100, "...") ?></p>
                    <p>
                        <a class="link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover <?= $colorLink ?>"
                           type="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseDescription-<?= $oneTask["id"] ?>" aria-expanded="false"
                           aria-controls="collapseDescription-<?= $oneTask["id"] ?>">
                            Показать полный текст задачи
                        </a>
                    </p>
                    <div style="min-height: 1px;">
                        <div class="collapse collapse-horizontal" id="collapseDescription-<?= $oneTask["id"] ?>">
                            <div class="card card-body" style="width: 750px;">
                                <?= $oneTask["description"] ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="mb-2"><?= $oneTask["description"] ?></p>
                <?php endif; ?>
            </div>

            <!-- Дополнительная информация -->
            <div class="task-info mb-1">
                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted"><strong>Статус:</strong> <?= ucfirst($oneTask["status"]) ?></p>
                    <p class="mb-0 text-muted"><strong>Приоритет:</strong> <?= ucfirst($oneTask["priority"]) ?></p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="mb-0 text-muted"><strong>Создано:</strong> <?= substr($oneTask["created_at"], 0, 10) ?>
                    </p>
                    <p class="mb-0 text-muted"><strong>Обновлено:</strong> <?= substr($oneTask["updated_at"], 0, 10) ?>
                    </p>
                </div>
                <div class="mt-2">
                    <input type="checkbox" class="form-check-input mb-2" data-id="<?= $oneTask["id"] ?>"
                           id="task-<?= $oneTask["id"] ?>" checked disabled/> Завершить задачу
                </div>
            </div>

            <!-- Действия
                <div class="task-actions d-flex justify-content-end">
                    <a class="btn btn-sm btn-warning me-2" title="Редактировать"
                       href="list/singlePageUpdateTasks.php?tasks=<?= $oneTask["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button id="deleted_task" class="btn btn-sm btn-danger" title="Удалить">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            -->
        </div>

    <?php endforeach; ?>

<?php else: ?>
    <strong>Название задачи</strong>
<?php endif; ?>
