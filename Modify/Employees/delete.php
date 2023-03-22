<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM employees AS employees WHERE MCN= :MCN");
$statement->bindParam(":MCN", $_GET["MCN"]);
$statement->execute();
header("Location: index.php");

?>