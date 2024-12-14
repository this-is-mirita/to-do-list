// обновление данных в таблицах
$(document).on('click', '#update_coments', function (e) {
    e.preventDefault();

    // Получаем блок по ближайшему атрибуту data-id
    let block = $(this).closest('[data-id]');
    let id = block.data('id'); // Получаем ID из data-id

    // Вызываем функцию для обработки данных
    updateTable_onId(id, block);
});

function updateTable_onId(id, block) {
    if (id) {
        console.log('ID блока:', id);

        // Сбор данных из всех input внутри блока
        let data = {};
        block.find('input').each(function () {
            // Используем текст в <a> как ключ
            let key = $(this).closest('.col-1, .col-2').find('a').text().trim();
            let value = $(this).val();

            data[key] = value; // Добавляем в объект
        });

        console.log('Собранные данные:', data);
         //Пример отправки данных на сервер через AJAX
        $.ajax({
            url: 'updateTable.php', // Ваш URL на бэке
            method: 'POST',
            data: {
                id: id,
                title: data['title'], // Используем ключи из объекта data
                comments: data['comment'] // Обратите внимание на имя ключа
            },
            success: function (response) {
                const rowId = response.rowId; // предполагаем, что сервер вернет id обновленной записи
                console.log(rowId);
            },
            error: function (error) {
                console.error('Ошибка:', error);
            }
        });
    }
}