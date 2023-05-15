<?php
const _HOST = "localhost:3333";
const _DB = "todo_list";
const _USER = "root";
const _PASS = "";
try {
    if (class_exists("PDO")) {
        $dsn = 'mysql:dbname=' . _DB . ';host=' . _HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAME utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $conn = new PDO($dsn, _USER, _PASS);
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br>";
    die();
}
