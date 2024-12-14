<?php
function getPdo()
{
    static $pdo = null;
    $host = "localhost";
    $user = "postgres";
    $password = "123";
    $database = "to-do-list-php";
    $charset = "utf8";

    // Используем правильный DSN для PostgreSQL
    $dsn = "pgsql:host=$host;dbname=$database;port=5432";

    // Опции подключения
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Если подключение еще не установлено, создаем его
    if ($pdo === null) {
        try {
            $pdo = new PDO($dsn, $user, $password, $opt); // Используем правильную переменную $pdo
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage(); // Выводим ошибку подключения
        }
    }

    return $pdo; // Возвращаем подключение
}
?>
