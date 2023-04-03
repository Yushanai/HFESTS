<?php require_once './../database.php';
if(isset($_POST["reference_number"])
    && isset($_POST["MCN"])
    && isset($_POST["name"])
    && isset($_POST["date"])
    && isset($_POST["startTime"])
    && isset($_POST["endTime"]))
{
    $statement = $conn->prepare("SELECT * FROM schedule WHERE MCN = :MCN AND date = :date AND 
    ((startTime <= :startTime AND endTime >= :startTime) OR (startTime >= :startTime AND startTime <= :endTime))");
    $statement->bindParam(':MCN', $_POST["MCN"]);
    $statement->bindParam(':date', $_POST["date"]);
    $statement->bindParam(':startTime', $_POST["startTime"]);
    $statement->bindParam(':endTime', $_POST["endTime"]);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        // If there are any conflicting schedules for the reference_number
        echo "A schedule with conflicting time already exists for this reference number.";
    } else {
        // If there are no conflicting schedules for the reference_number, proceed to update the schedule
        $statement = $conn->prepare("UPDATE schedule SET MCN=:MCN, name=:name, date=:date, startTime=:startTime, 
        endTime=:endTime WHERE reference_number = :reference_number;");
        $statement->bindParam(':reference_number', $_POST["reference_number"]);
        $statement->bindParam(':MCN', $_POST["MCN"]);
        $statement->bindParam(':name', $_POST["name"]);
        $statement->bindParam(':date', $_POST["date"]);
        $statement->bindParam(':startTime', $_POST["startTime"]);
        $statement->bindParam(':endTime', $_POST["endTime"]);
        $statement->execute();
        header("Location: ./index.php"); //If succsessful, bring the user to the previous location
    }
}
/*
$statement = $conn->prepare("SELECT* FROM schedule WHERE reference_number = :reference_number ");
$statement->bindParam(":reference_number", $_GET["reference_number"]);
$statement->execute();
$employees = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["reference_number"])
    && isset($_POST["MCN"])
    && isset($_POST["name"])
    && isset($_POST["date"])
    && isset($_POST["startTime"])
    && isset($_POST["endTime"]))
{    $statement =  $conn->prepare("UPDATE schedule SET MCN=:MCN, name=:name, date=:date, startTime=:startTime, 
                                        endTime=:endTime WHERE reference_number = :reference_number;");

    $statement->bindParam(':reference_number', $_POST["reference_number"]);
    $statement->bindParam(':MCN', $_POST["MCN"]);
    $statement->bindParam(':name', $_POST["name"]);
    $statement->bindParam(':date', $_POST["date"]);
    $statement->bindParam(':startTime', $_POST["startTime"]);
    $statement->bindParam(':endTime', $_POST["endTime"]);



}


//}
if ($statement->execute()) {
    // Query executed successfully
    header("Location: ./index.php"); //If succsessful, bring the user to the previous location
    // exit;
}
//else{
// header("location: ./edit.php?MCN=".$_POST["MCN"]);
//}
*/
?>