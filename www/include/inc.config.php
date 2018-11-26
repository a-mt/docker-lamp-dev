<?php
if (!isset($_ENV['DEBUG'])) {
    $_ENV = parse_ini_file(__DIR__ . '/../.env.ini', false, INI_SCANNER_TYPED);
}

// START SESSION
ob_start();
session_start();

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'C.UTF-8');