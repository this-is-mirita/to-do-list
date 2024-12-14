<form action="list/createtask/add_task.php" method="POST" class="border p-4 rounded shadow-sm">
    <h4 class="mb-4">Создать новую задачу</h4>

    <!-- Название задачи -->
    <div class="mb-3">
        <label for="taskTitle" class="form-label"><strong>Название задачи</strong></label>
        <input type="text" id="taskTitle" name="title" class="form-control" placeholder="Введите название" required>
    </div>

    <!-- Описание задачи -->
    <div class="mb-3">
        <label for="taskDescription" class="form-label"><strong>Содержание задачи</strong></label>
        <textarea id="taskDescription" name="description" class="form-control" rows="4"
                  placeholder="Введите описание задачи" required></textarea>
    </div>

    <!-- Статус -->
    <div class="mb-3">
        <label for="taskStatus" class="form-label"><strong>Статус</strong></label>
        <select id="taskStatus" name="status" class="form-select" required>
            <option value="pending">В ожидании / "pending"</option>
            <option value="completed">Завершено / "completed"</option>
        </select>
    </div>

    <!-- Приоритет -->
    <div class="mb-3">
        <label for="taskPriority" class="form-label"><strong>Приоритет</strong></label>
        <select id="taskPriority" name="priority" class="form-select" required>
            <option value="low">Низкий / low</option>
            <option value="medium">Средний / medium</option>
            <option value="high">Высокий / high</option>
        </select>
    </div>

    <!-- Кнопка отправки -->
    <div class="d-flex justify-content-end">
        <button id="create_task" type="" class="btn btn-primary">Создать задачу</button>
    </div>
</form>
<script src="list/createtask/createtask.js"></script>