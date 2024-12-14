$("#create_task").on('click', function (e) {
    e.preventDefault();

    const taskTitle = $('#taskTitle').val();
    const taskDescription = $('#taskDescription').val();
    const taskStatus = $('#taskStatus').val();
    const taskPriority = $('#taskPriority').val();
    $.ajax({
        url: 'list/createtask/add_task.php',
        type: 'post',
        data: {
            taskTitle: taskTitle,
            taskDescription: taskDescription,
            taskStatus: taskStatus,
            taskPriority: taskPriority
        },
        success: function (res) {
            // направление на главную страницу
            window.loadPage("all_task");
        },
        error: function (xhr, status, error) {
            console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
            alert("Ошибка при выполнении запроса: " + error);
        }
    })
});