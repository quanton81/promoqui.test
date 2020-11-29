<?php
$db['dsn'] = 'mysql:dbname=db;host=promoqui_db;port=3306';
$db['username'] = 'root';
$db['password'] = 'root';
$db['options'] = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
];

return $db;
