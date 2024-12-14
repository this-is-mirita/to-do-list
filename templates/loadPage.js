// Получение по клику страницы и передача её в функцию
$(function () {
    // Делегируем событие клика для ссылок с data-page
    $("body").on("click", "a[data-page]", function (e) {
        e.preventDefault(); // Предотвращаем переход по ссылке

        let page = $(this).data("page"); // Получаем data-page
        if (page) {
            loadPage(page); // Загружаем указанную страницу
            
            // Удаляем класс 'active' у всех элементов списка
            $("ul.list-group .list-group-item").removeClass("active");
            // Добавляем класс 'active' к родительскому <li> текущей ссылки
            $(this).closest(".list-group-item").addClass("active");
        }
    });
});

// Отправка запроса для загрузки страницы
function loadPage(page) {
    const basePath = "list/"; // Базовый путь к файлам
    $.ajax({
        url: basePath + page + ".php", // Учитываем базовый путь
        method: "GET",
        success: function (response) {
            // Загружаем содержимое в #render
            $("#render").html(response);
        },
        error: function () {
            // Сообщение об ошибке
            $("#render").html(
                '<p class="text-danger">Не удалось загрузить данные. Попробуйте еще раз.</p>'
            );
        },
    });
}