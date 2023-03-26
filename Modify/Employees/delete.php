<?php require_once '../../database.php';

$statement = $conn->prepare("DELETE FROM employees WHERE MCN= :MCN");
$statement->bindParam(":MCN", $_GET["MCN"]);
$statement->execute();
if( $statement->execute()){

    header("Location: ../index.php"); //If succsessful, bring the user to the previous location

    exit;
}
?>