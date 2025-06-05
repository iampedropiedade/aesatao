<?php
$databaseSettings = [
    'default-connection' => 'concrete',
    'connections' => [
        'concrete' => [
            'driver' => 'concrete_pdo_mysql',
            'server' => 'aesatao_db',
            'database' => 'app',
            'username' => 'app',
            'character_set' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ],
];

$secrets_file = dirname(__FILE__) . '/secrets.php';
if (file_exists($secrets_file)) {
    include $secrets_file;
}

return $databaseSettings;