<div class="container mt-5">
  <h1 class="text-center">Все задачи</h1>
  <div class="row">
    <div class="col-3">
      <ul class="list-group">
        <!-- Ссылки для выбора задач -->
        <li class="list-group-item" aria-current="true">
          <!-- /templates/list/active_task.php -->
          <a data-page="all_task">Все задачи</a>
        </li>
        <li class="list-group-item">
          <a data-page="success_task">Выполненные</a>
        </li>
        <li class="list-group-item">
          <a data-page="createtask/createTask">Создать задачу</a>
        </li>
      </ul>
    </div>

    <div class="col-9">
      <div id="render">
        <!-- Здесь будет отображаться загруженный контент -->
      </div>
    </div>
  </div>
</div>
<!-- загрузка страниц -->
<script src="templates/loadPage.js"></script>

