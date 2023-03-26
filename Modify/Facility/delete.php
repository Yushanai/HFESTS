<?php require_once '../../database.php';

$statement = $conn->prepare("DELETE FROM facilities AS facilities WHERE name= :name");
$statement->bindParam(":name", $_GET["name"]);
$statement->execute();
header("Location: ../index.php");
?>