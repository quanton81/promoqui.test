<?php

$dbConfig = require dirname(__DIR__) . '/db/db-config.php';

try {
    $PDO = new \PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password'], $dbConfig['options']);
} catch (\PDOException $e) {
    echo $e->getMessage();
}

return $PDO;