<?php
session_start();
$server = 'usw-cynosdbmysql-grp-kzimrklj.sql.tencentcdb.com:24884';
$username = 'root';
$password = '741Xu741.';
$database = 'Hospital';


try{
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die('Connection Failed: '. $e->getMessage());
}
?>



