// <?php
// session_start();
// require_once __DIR__ . '/../error/err.php';
// require_once __DIR__ . '/../DataBaseConnection/connect.php';
// require_once __DIR__ . '/../ajax_admins/querys_functions.php';
//
//
// $pdo = getPdo();
// // Проверяем статус чекбокса: если 'true', выбираем только администраторов, иначе всех пользователей
// $status = isset($_GET['status']) && $_GET['status'] === 'true' ? true : false;
//
// if ($status) {
//     $sql = "SELECT * FROM users WHERE admin = ?";
//     $query = $pdo->prepare($sql);
//     $query->execute([$status]); // Фильтруем только администраторов
// } else {
//     $sql = "SELECT * FROM users"; // Возвращаем всех пользователей
//     $query = $pdo->prepare($sql);
//     $query->execute(); // Выполняем без фильтра
// }
//
// $users = $query->fetchAll(PDO::FETCH_ASSOC);
// echo json_encode(['users' => $users]);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
