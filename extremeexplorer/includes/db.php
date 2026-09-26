<?php
declare(strict_types=1);

// XAMPP defaults are usually: host 127.0.0.1, user root, blank password.
// Change these values if your local MySQL setup is different.
$databaseHost = '127.0.0.1';
$databaseName = 'extreme_explorer';
$databaseUser = 'root';
$databasePassword = '';

try {
    $pdo = new PDO(
        "mysql:host={$databaseHost};dbname={$databaseName};charset=utf8mb4",
        $databaseUser,
        $databasePassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $exception) {
    // Do not reveal database credentials or detailed server errors to visitors.
    error_log($exception->getMessage());
    $pdo = null;
}

