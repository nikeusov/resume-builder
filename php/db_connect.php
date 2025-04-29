<?php
$host = 'localhost';
$db = 'resume_builder';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4"; // Добавляем charset=utf8mb4
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Обработка ошибок
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Возвращать результаты как ассоциативный массив
    PDO::ATTR_EMULATE_PREPARES => false, // Отключаем эмуляцию подготовленных запросов
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>