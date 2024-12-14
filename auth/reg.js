$(function () {
  $("#btn_reg").on("click", function (e) {
    e.preventDefault();
    console.log("click");

    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let email = $("#email").val();
    let age = $("#age").val();
    let password = $("#password").val();

    $.ajax({
      url: "../auth/register.php",
      method: "post",
      data: {
        first_name: first_name,
        last_name: last_name,
        email: email,
        age: age,
        password: password,
      },
      success: function (response) {
        window.location.href = "/";
      },
      error: function (xhr, status, error) {
        console.error("Ошибка AJAX запроса:", status, error, xhr.responseText);
        alert("Ошибка при выполнении запроса: " + error);
      },
    });
  });
});
