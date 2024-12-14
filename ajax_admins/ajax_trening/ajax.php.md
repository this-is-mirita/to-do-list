<div class="container py-5 d-none">
    <div class="position-relative">
        <h2 class="text-center mb-4">Search</h2>
        <form action="../ajaxPhp.php" method="post">
            <input type="text" name="search" id="search" class="form-control" placeholder="Type to search...">
        </form>
        <div id="result"></div>
    </div>
</div>
<script>
    $(function () {
        // $(function () { ... }) — это сокращение для $(document).ready(function() { ... }).
        // Код внутри будет выполняться, когда DOM полностью загружен.
        let debounceTimer;
        // Переменная для хранения таймера (дебаунса), чтобы избежать лишних AJAX-запросов.
        $('#search').keyup(function () {
            // Привязываем событие `keyup` (отпускание клавиши) к элементу с id="search".
            clearTimeout(debounceTimer);
            // Очищаем ранее установленный таймер, чтобы избежать выполнения старого запроса.
            debounceTimer = setTimeout(() => {
                // Устанавливаем новый таймер (дебаунс) с задержкой в 300 мс.
                let search = $('#search').val().trim();
                // Получаем значение из поля ввода (удаляем пробелы в начале и конце строки).
                if (search === '') {
                    // Проверяем, пустое ли поле ввода.
                    $('#result').hide();
                    // Если поле пустое, скрываем блок с результатами.
                    return;
                    // Прерываем выполнение дальнейшего кода.
                } else {
                    // Если поле ввода не пустое:
                    $('#result').show();
                    // Показываем блок с результатами.
                }
                $.ajax({
                    url: 'ajax_controllerSearch.php',
                    // Указываем URL контроллера, который будет обрабатывать запрос.
                    type: 'POST',
                    // Используем метод POST для отправки данных на сервер.
                    dataType: 'json',
                    // Ожидаем, что сервер вернёт JSON-ответ.
                    data: {search: search},
                    // Отправляем значение поля ввода (`search`) на сервер.
                    success: function (data) {
                        // Выполняется при успешном выполнении AJAX-запроса.
                        console.log("Ответ от сервера:", data);
                        // Логируем ответ сервера в консоль для отладки.
                        $('#result').html('');
                        // Очищаем содержимое блока с результатами.
                        if (Array.isArray(data)) {
                            // Проверяем, является ли ответ сервера массивом.
                            if (data.length === 0) {
                                // Если массив пустой:
                                $('#result').html('<p>Нет результатов</p>');
                                // Выводим сообщение "Нет результатов".
                            } else {
                                // Если массив содержит элементы:
                                data.forEach(video => {
                                    // Перебираем каждый элемент массива.
                                    $('#result').append(`
                                        <p>
                                            <a href="../video/templateEditedVideo.php?id=${video.id}">${video.name_tyan}</a>
                                        </p>
                                    `);
                                    // Добавляем название видео в блок результатов.
                                });
                            }
                        } else {
                            // Если ответ не массив:
                            console.error("Ожидался массив, но получено:", data);
                            // Логируем ошибку в консоль.
                            $('#result').html('<p>Ошибка обработки данных</p>');
                            // Показываем сообщение об ошибке в блоке результатов.
                        }
                    },
                    error: function (xhr, status, error) {
                        // Выполняется при ошибке AJAX-запроса.
                        console.error("Ошибка AJAX запроса:", error);
                        // Логируем сообщение об ошибке.
                        alert('Ошибка при выполнении запроса');
                        // Показываем пользователю уведомление об ошибке.
                    }
                });
            }, 200);
            // Таймаут в 300 мс для предотвращения слишком частых запросов.
        });
    });
</script>
<div class="container py-5 d-none">
    <div class="position-relative row">
        <h2 class="mb-4">checked</h2>
        <div class="col-md-2">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
            </div>
        </div>
        <div class="col-md-2">
            <form action="../ajaxPhp.php" method="post">
                <input type="text" name="search_checkbox" id="search_checkbox" class="form-control"
                       placeholder="Type to search...">
            </form>
        </div>
        <div id="result_checked" style="width:1000px;">

        </div>
    </div>

</div>
<script>
    // checkbox
    $(function () {
        $('#result_checked').hide(); // Скрываем результат по умолчанию
        $('#flexSwitchCheckDefault').on('change', function () {
            let currentState = $(this).prop('checked');
            console.log(currentState);
            if (currentState) {
                $.ajax({
                    url: 'ajax_controllerTable.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { table: 'table' },
                    success: function (data) {
                        $('#result_checked').empty(); // Очищаем контейнер перед добавлением
                        if (data.length === 0) {
                            $('#result_checked').append('<p>Нет доступных данных.</p>').fadeIn();
                            return;
                        }
                        data.forEach(table => {
                            let tableEl = $(`
                            <div class="row mb-3 p-2 border rounded bg-light">
                                <div class="col-md-1 text-center">
                                    <strong>ID</strong>
                                    <p class="mb-0">${table.id}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <strong>prew</strong>
                                    <a href="/video/templateEditedVideo.php?id=${table.id}" class="mb-0 text-truncate">link</a>
                                </div>
                                <div class="col-md-2 text-center">
                                    <strong>Name Video</strong>
                                    <p class="mb-0 text-truncate">${table.name_video}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <strong>Name Tyan</strong>
                                    <p class="mb-0 text-truncate">${table.name_tyan}</p>
                                </div>
                                <div class="col-md-1 text-center">
                                    <strong>Likes</strong>
                                    <p class="mb-0">${table.likes}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <strong>Sort Name</strong>
                                    <p class="mb-0 text-truncate">${table.sort_name}</p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${table.id}">Удалить</button>
                                </div>
                            </div>
                        `);
                            $('#result_checked').append(tableEl);
                            tableEl.fadeIn(); // Плавное появление
                        });
                        $('#result_checked').fadeIn(); // Показываем контейнер
                    },
                    error: function (xhr, status, error) {
                        console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
                        alert('Ошибка при выполнении запроса: ' + error);
                    }
                });
            } else {
                $('#result_checked').fadeOut(); // Плавное исчезновение
                console.log('Чекбокс не активен');
            }
        });
    });
    // delet
    $(function () {
        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: 'ajax_controllerDelete.php',
                type: 'get',
                dataType: 'json',
                data: { id: id },
                success: function (data){
                    if (data.success) {
                        //alert(data.message); // Показываем сообщение об успешном удалении
                        // Удаляем элемент из DOM
                        $(`[data-id="${id}"]`).closest('.row').remove();
                    } else {
                        alert('Ошибка: ' + data.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
                    alert('Ошибка при выполнении запроса: ' + error);
                }
            })
        });
    });
    // search no server
    $(function () {
        $('#search_checkbox').on('keyup', function () {
            let searchText = $(this).val().toLowerCase(); // Получаем текст из поля поиска
            console.log(searchText);
            $('#result_checked .row').filter(function () { // Правильный селектор строк
                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                // Показываем или скрываем строки, в зависимости от наличия текста
            });
        });
    });

</script>
