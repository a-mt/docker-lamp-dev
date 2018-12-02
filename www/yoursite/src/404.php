<?php

// Placeholder image
$ext  = strtolower(strrchr($_SERVER['REDIRECT_URL'], '.'));
$aImg = array('.png', '.jpg', '.jpeg', '.gif', '.bmp');

if (in_array($ext, $aImg)) {
    header('Content-Type: image/png');
    echo file_get_contents(__DIR__ . '/assets/img/404.jpg');
    exit();
}

// 404 page
require_once __DIR__ . '/../include/inc.config.php';
echo '404';
