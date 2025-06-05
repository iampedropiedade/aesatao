<?php
$concreteSettings = [
    'locale' => 'pt_PT',
    'misc' => [
        'do_page_reindex_check' => false,
    ],
    'user' => [
        'registration' => [
            'email_registration' => true,
            'type' => 'disabled',
            'captcha' => false,
            'display_username_field' => true,
            'display_confirm_password_field' => true,
            'enabled' => false,
            'notification' => false,
        ],
    ],
    'email' => [
        'default' => [
            'address' => 'website@escolasdesatao.pt',
            'name' => 'Agrupamento de Escolas de Sátão',
        ],
        'forgot_password' => [
            'address' => 'website@escolasdesatao.pt',
            'name' => 'Agrupamento de Escolas de Sátão',
        ],
        'workflow_notification' => [
            'address' => 'website@escolasdesatao.pt',
            'name' => 'Agrupamento de Escolas de Sátão',
        ],
    ],
    'theme' => [
        'compress_preprocessor_output' => false,
        'generate_less_sourcemap' => false,
    ],
    'upload' => [
        'extensions' => '*.flv;*.jpg;*.gif;*.jpeg;*.ico;*.docx;*.xla;*.png;*.psd;*.swf;*.doc;*.txt;*.xls;*.xlsx;*.csv;*.pdf;*.tiff;*.rtf;*.m4a;*.mov;*.wmv;*.mpeg;*.mpg;*.wav;*.3gp;*.avi;*.m4v;*.mp4;*.mp3;*.qt;*.ppt;*.pptx;*.kml;*.xml;*.svg;*.webm;*.ogg;*.ogv;*.zip',
    ],
    'security' => [
        'session' => [
            'invalidate_on_ip_mismatch' => false,
        ],
        'trusted_proxies' => [
            'ips' => [
                '127.0.0.1',
                '::1',
            ],
            'headers' => -1,
        ],
    ],
];

$secrets_file = dirname(__FILE__) . '/secrets.php';
if (file_exists($secrets_file)) {
    include $secrets_file;
}

return $concreteSettings;