<?php
require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
} catch (Exception $e) {
    die('Dotenv error: ' . $e->getMessage());
}

return [
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'db',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'pass' => $_ENV['DB_PASS'] ?? '',
        'name' => $_ENV['DB_NAME'] ?? 'burger_site'
    ],
    'mailer' => [
        'host' => $_ENV['SMTP_HOST'] ?? 'mail',
        'port' => $_ENV['SMTP_PORT'] ?? 587,
        'auth' => $_ENV['SMTP_AUTH'] ?? false,
        'user' => $_ENV['SMTP_USER'] ?? '',
        'pass' => $_ENV['SMTP_PASS'] ?? '',
        'secure' => $_ENV['SMTP_SECURE'] ?? ''
    ],
    'jwt' => [
        'secret' => $_ENV['JWT_SECRET'] ?? 'dev-secret-key'
    ]
];