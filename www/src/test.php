<?php
require_once __DIR__ . '/../include/inc.config.php';

try {
    $dbh = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

    $dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add MySQL Cache
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

} catch (PDOException $e) {
    echo 'Error database connexion : ' . $e->getMessage();
    die;
}

$res = $dbh->query('SELECT 1')->fetchColumn();
echo 'SELECT ' . $res;
