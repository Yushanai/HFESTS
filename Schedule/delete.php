<?php require_once './../database.php';

$statement = $conn->prepare("DELETE FROM schedule WHERE reference_number= :reference_number");
$statement->bindParam(":reference_number", $_GET["reference_number"]);
$statement->execute();
if( $statement->execute()){

    header("Location: ./index.php"); //If succsessful, bring the user to the previous location

    exit;
}
?>