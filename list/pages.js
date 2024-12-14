// получение клика по чекбоксу и передача в функцию
$(document).on('change', '.form-check-input-end-tasks', function () {
    let checkbox = $(this);
    let id = checkbox.data('id');
    const status = checkbox.is(':checked') ? 'completed' : 'pending';
    complitedTasks(id, status, checkbox.closest('.task-item'));
});

// отправляем запрос чтоб задача стала в сдругой статус и перешла в выволненые
function complitedTasks(id, status, block) {
    $.ajax({
        url: '../list/update_task_status.php',
        method: 'POST',
        data: {id: id, status: status},
        success: function (response) {
            if (response.success) {
                block.remove();
            } else {
                console.error("Ошибка:", response.message || "Неизвестная ошибка");
            }
        },
        error: function (xhr, status, error) {
            console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
            alert("Ошибка при выполнении запроса: " + error);
        }
    });
}

// удаление таска
$(document).on('click', 'button', function (e) {
    e.preventDefault();

    let id = $(this).data('id'); // Получаем ID задачи
    deleteTasks(id, $(this)); // Передаём ID и текущую кнопку
});

// передеача шв и батона в запрос, потом удаление блока через батон через closest
function deleteTasks(id, button) {
    $.post('../list/deletetask/deletetask.php', {id: id})
        .done(res => {
            const taskElement = button.closest('.task-item');
            taskElement.remove();
        })
        .fail((xhr, status, error) => {
            console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
            alert("Ошибка при выполнении запроса: " + error);
        });
}

// фильтрация задачи по инпутам
$(document).on('change', 'input', function () {
    let checkbox = $(this);
    let priority = checkbox.data('priority');
    let status = checkbox.is(':checked') ? '1' : '0';
    // загрузка по приоритету задачи
    checkboxChange(priority, status);
});

function checkboxChange(priority, status) {
    if (status === '1') {
        switch (priority) {
            case "low":
                loadCountTasks(priority)
                break;
            case "medium":
                loadCountTasks(priority)
                break;
            case "high":
                loadCountTasks(priority)
                break;
            default:
                console.log('q');
        }
    } else {
        window.loadPage("all_task");
    }
}

function loadCountTasks(priority) {
    $.post('../list/priorityTask/priority.php', {priority: priority})
        .done(res => {
            const mainContainer = $('#mainContainer');
            mainContainer.empty();


            res.forEach(task => {
                const borderTasks = getColorBorder(task.priority);
                const description = task.description.length > 100
                    ? `
                        <p class="mb-2 text-truncate" style="max-width: 750px;">
                            ${task.description.substring(0, 100)}...
                        </p>
                        <a class="text-decoration-underline text-primary" type="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseDescription-${task.id}" aria-expanded="false"
                           aria-controls="collapseDescription-${task.id}">
                            Показать полный текст задачи
                        </a>
                        <div class="collapse mt-2" id="collapseDescription-${task.id}">
                            <div class="card card-body">
                                ${task.description}
                            </div>
                        </div>
                    `
                    : `<p class="mb-2">${task.description}</p>`;

                const taskHTML = `
                    <div id="containerAllTasks-${task.id}"
                         class="task-item d-flex flex-column border ${borderTasks} p-4 mt-3 rounded shadow-sm"
                         data-id="${task.id}">

                        <!-- Название задачи -->
                        <div class="task-title mb-2">
                            <strong class="d-block">Название задачи:</strong>
                            <h5 class="text- mb-0">${task.title}</h5>
                        </div>

                        <!-- Содержание задачи -->
                        <div class="task-description mb-2">
                            <strong class="d-block">Содержание задачи:</strong>
                            ${description}
                        </div>

                        <!-- Дополнительная информация -->
                        <div class="task-info mb-3">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 text-muted"><strong>Статус:</strong> ${task.status}</p>
                                <p class="mb-0 text-muted"><strong>Приоритет:</strong> ${task.priority}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 text-muted"><strong>Создано:</strong> ${task.created_at.substring(0, 10)}</p>
                                <p class="mb-0 text-muted"><strong>Обновлено:</strong> ${task.updated_at.substring(0, 10)}</p>
                            </div>
                            <div class="mt-3">
                                <input type="checkbox" class="form-check-input form-check-input-end-tasks"
                                       data-id="${task.id}" id="task-${task.id}"/> Завершить задачу
                            </div>
                        </div>

                        <!-- Действия -->
                        <div class="task-actions d-flex justify-content-end">
                            <a class="btn btn-sm btn-warning me-2" title="Редактировать"
                               href="list/singlePageUpdateTasks.php?tasks=${task.id}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button data-id="${task.id}" id="deleted_task-${task.id}"
                                    class="btn btn-sm btn-danger" title="Удалить">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                // Добавляем задачу в контейнер
                mainContainer.append(taskHTML);
            });

        })
        .fail((xhr, status, error) => {
            console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
            alert("Ошибка при выполнении запроса: " + error);
        });
}

function getColorBorder(priority) {
    switch (priority) {
        case "low":
            return "border-success";
            break;
        case "medium":
            return "border-warning";
            break;
        case "high":
            return "border-danger";
            break;
        default:
            console.log('q');
    }
}

// поиск по задачам
$(function () {
    $("#search_checkbox").on("keyup", function () {
        let searchText = $(this).val().toLowerCase(); // Получаем текст поиска
        console.log(searchText);

        if (searchText.trim() === "") {
            // Если поле поиска пустое, показываем все задачи
            $(".task-item").show();
            return;
        }

        $(".task-item").each(function () {
            const title = $(this).find("h5").text().toLowerCase(); // Текст заголовка
            const description = $(this).find(".task-description").text().toLowerCase(); // Текст описания

            // Показываем только те задачи, где есть совпадение в заголовке или описании
            if (title.includes(searchText) || description.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});








