// поиск по таблицам
$(function () {
  $("#search_checkbox").on("keyup", function () {
    let searchText = $(this).val().toLowerCase(); // Получаем текст из поля поиска
    $("#result .row").each(function () {
      // Пробегаемся по всем строкам
      const rowText = $(this).text().toLowerCase(); // Текст всей строки
      let inputValues = "";

      // Получаем значения input, если они есть
      $(this)
        .find("input")
        .each(function () {
          inputValues += $(this).val().toLowerCase();
        });

      // Проверяем совпадения в тексте строки или в значениях input
      if (
        rowText.indexOf(searchText) > -1 ||
        inputValues.indexOf(searchText) > -1
      ) {
        $(this).show(); // Показываем строку
      } else {
        $(this).hide(); // Скрываем строку
      }
    });
  });
});
// клик на селект и передача значения в функцию
$("#table_select").change(function () {
  let table_load = $(this).val();
  load_table_ajax(table_load);
});
// аякс для функций
function load_table_ajax(table_load) {
  //console.log(table_load);
  $.ajax({
    url: "getAllFromTable.php",
    type: "POST",
    data: { table_select: table_load },
    success: function (data) {
      if (data.error) {
        console.error("Ошибка:", data.error);
        $("#result").html("<p>" + data.error + "</p>");
      }
      //console.log(table_load);
      switch (table_load) {
        case "Users":
          users_table(data, table_load);
          break;
        case "Comments":
          comments_table(data, table_load);
          break;
        case "Posts":
          posts_table(data, table_load);
          break;
        case "Video":
          video_table(data, table_load);
          break;
        default:
          alert("Nobody!");
      }
    },
    error: function (xhr, status, error) {
      console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
      alert("Ошибка при выполнении запроса: " + error);
    },
  });
}
function users_table(data, users) {
  let result = `
        <div class="container">
            <div class="row">
                <div style="display: flex; align-items: center;">
                    <div class="form-check" style="margin-right: 1rem">
                        <input class="form-check-input" type="checkbox" value="" id="get_admin">
                        <label class="form-check-label" for="get_admin">
                            admin
                        </label>
                    </div>
                    <div class="form-check" style="margin-right: 1rem">
                        <input class="form-check-input" type="checkbox" value="" id="first_five">
                        <label class="form-check-label" for="first_five">
                            fitsr 5
                        </label>
                    </div>
                    <div class="form-check" style="margin-right: 1rem">
                        <input class="form-check-input" type="checkbox" value="" id="last_five">
                        <label class="form-check-label" for="last_five">
                            last 5
                        </label>
                    </div>
                </div>
            </div>
        `;
  data.forEach((row) => {
    result += `
            <div class="row align-items-center border py-2 mb-2 admin" data-admin="${row.admin}">
                <div class="col-1 text-center">${row.id}</div>
                <div class="col-1"><input type="text" class="form-control" value="${row.username}"></div>
                <div class="col-3"><input type="text" class="form-control" value="${row.password_hash}"></div>
                <div class="col-3"><input type="email" class="form-control" value="${row.email}"></div>
                <div class="col-1 text-center">${row.admin}</div>
                <div class="col-2 d-flex justify-content-between">
                    <button class="btn btn-success btn-sm">Обновить</button>
                    <button class="btn btn-danger btn-sm">Удалить</button>
                </div>
            </div>
        `;
  });
  result += `</div>`;
  $("#result").html(result);
}
function posts_table(data, posts) {
  let result = `<div class="container">`;
  data.forEach((row) => {
    result += `
            <div class="row align-items-center border py-2 mb-2">
                <div class="col-1 text-center">${row.id}</div>
                <div class="col-2"><input type="text" class="form-control" value="${row.title}"></div>
                <div class="col-1"><input type="text" class="form-control" value="${row.img_link || ""}"></div>
                <div class="col-2"><input type="text" class="form-control" value="${row.description || ""}"></div>
                <div class="col-1 text-center">${row.likes}</div>
                <div class="col-1 text-center">${row.followers}</div>
                <div class="col-2 text-center">${row.created_at}</div>
                <div class="col-2 d-flex justify-content-between">
                    <button class="btn btn-success btn-sm">Обновить</button>
                    <button class="btn btn-danger btn-sm">Удалить</button>
                </div>
            </div>
        `;
  });
  result += `</div>`;
  $("#result").html(result);
}
function video_table(data, video) {
  let result = `<div class="container">`;
  data.forEach((row) => {
    result += `
            <div class="row align-items-center border py-2 mb-2">
                <div class="col-1 text-center">${row.id}</div>
                <div class="col-2"><input type="text" class="form-control" value="${row.user_added}"></div>
                <div class="col-2"><input type="text" class="form-control" value="${row.name_tyan}"></div>
                <div class="col-2"><input type="text" class="form-control" value="${row.video}"></div>
                <div class="col-2 text-center"><input type="text" class="form-control" value="${row.sort_name}"></div>
                <div class="col-2 d-flex justify-content-between">
                    <button class="btn btn-success btn-sm">Обновить</button>
                    <button class="btn btn-danger btn-sm">Удалить</button>
                </div>
            </div>
        `;
  });
  result += `</div>`;
  $("#result").html(result);
}
function comments_table(data, comments) {
  let result = `<div class="container">`;
  data.forEach((row) => {
    result += `
            <div data-id="${row.id}" class="row align-items-center border py-2 mb-2">
                <a>id</a>
                <div class="col-1 text-center" >${row.id}</div>
                <div class="col-1">
                    <a>tyan_id</a>
                    <input type="text" class="form-control" value="${row.tyan_id}">
                </div>
                <div class="col-1">
                    <a>user_id</a>
                    <input type="text" class="form-control" value="${row.user_id}"></div>
                <div class="col-1">
                    <a>tyan_id</a>
                    <input type="text" class="form-control" value="${row.username}"></div>
                <div class="col-1">
                    <a>title</a>
                    <input type="text" class="form-control" value="${row.title || ""}"></div>
                <div class="col-2">
                    <a>comment</a>
                    <input type="text" class="form-control" value="${row.comment || ""}"></div>
                <div class="col-2 text-center">${row.created_at}</div>
                <div class="col-2 d-flex justify-content-between">
                    <button id="update_coments" class="btn btn-success btn-sm">Обновить</button>
                    <button class="btn btn-danger btn-sm">Удалить</button>
                </div>
            </div>
        `;
  });
  result += `</div>`;
  $("#result").html(result);
}

// Делегирование событий для динамически добавленных чекбоксов по русски если создали тут то надо делегироание
//$(document).on('click', '.form-check-input', function () {
//    let id = $(this).attr('id');
//    let status = $(this).is(':checked'); // Получаем состояние чекбокса как true/false
//    console.log('ID чекбокса:', id);
//    console.log('Статус чекбокса:', status);
//
//    if (id === 'get_admin') {
//        $.ajax({
//            url: 'getAdmin.php', // URL PHP-скрипта
//            method: 'GET',
//            data: { status: status.toString() }, // Преобразуем статус в строку перед отправкой
//            success: function (response) {
//                try {
//                    const data = JSON.parse(response); // Парсим JSON-ответ
//                    console.log('Полученные данные:', data);
//
//                    // Обновляем таблицу пользователей
//                    users_table(data.users);
//                } catch (e) {
//                    console.error('Ошибка парсинга ответа:', e);
//                }
//            },
//            error: function (error) {
//                console.error('Ошибка AJAX-запроса:', error);
//            }
//        });
//    } else {
//        console.log('Чекбокс не относится к админам');
//    }
//});
