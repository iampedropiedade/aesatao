<?php
$appSettings = [
    'theme_paths' =>
        [
            '/login'     => 'aesatao',
            '/register'  => 'aesatao',
            '/account/*' => 'aesatao',
            '\Throwable' => 'aesatao',
        ],
    'server_timezone' => 'Europe/Lisbon',
    'api_keys' => [
        'google' => [
            'maps' => 'AIzaSyAPNFa-Cn1voBzqE0cvTda2ONF9DkIIl_I'
        ]
    ],
    'sentry' => [
        'environment' => 'production',
    ],
];

$secretsFile = dirname(__FILE__) . '/secrets.php';
if (file_exists($secretsFile)) {
    include $secretsFile;
}
return $appSettings;