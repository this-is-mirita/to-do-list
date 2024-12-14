<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>123</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container mt-4" style="max-width: 1000px;">
    <div class="d-flex align-items-center">
        <!-- Выпадающий список -->
        <select class="form-select form-select-lg me-2" style="border-radius: 0;" name="table_select" id="table_select">
            <option selected>Выберите таблицу</option>
            <option value="Users">Users</option>
            <option value="Comments">Comments</option>
            <option value="Posts">Posts</option>
            <option value="Video">Video</option>
        </select>
    </div>

    <h3 class="mt-2">Выбрана таблица: </h3>
    <div class="mt-2">
        <form>
            <input name="search_checkbox" id="search_checkbox" type="text" class="form-control form-control-lg"
                   placeholder="Введите текст" style="border-radius: 0;">
        </form>
    </div>
</div>
<!-- load content here -->
<div class="mt-4" id="result"></div>

<script src="createTable.js"></script>
<script src="updateTable.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>