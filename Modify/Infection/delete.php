<?php require_once '../../database.php';

$statement = $conn->prepare("DELETE FROM infection_history  WHERE MCN= :MCN");
$statement->bindParam(":MCN", $_GET["MCN"]);
$statement->execute();
header("Location: ../index.php");
?>