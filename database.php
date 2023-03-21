<?php
session_start();
$server = 'localhost: 3306';
$username = 'root';
$password = '741x741';
$database = 'comp353project';


try{
    $conn = new PDO("mysql: host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: '. $e->getMessage());
}

?>