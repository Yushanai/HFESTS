<?php require_once './../database.php';

if(isset($_POST["reference_number"])
    && isset($_POST["MCN"])
    && isset($_POST["name"])
    && isset($_POST["date"])
    && isset($_POST["startTime"])
    && isset($_POST["endTime"])) {
    $statement = $conn->prepare("SELECT * FROM schedule 
                             WHERE MCN = :MCN 
                             AND date = :date 
                             AND (
                                   (startTime <= :startTime AND endTime >= :startTime) 
                                   OR (startTime >= :startTime AND startTime <= :endTime) 
                                   OR (startTime < :startTime AND endTime < :endTime AND TIMEDIFF(:startTime, endTime) < '01:00:00')
                                   OR (startTime > :startTime AND endTime > :endTime AND TIMEDIFF(startTime, :endTime) < '01:00:00')
                                 )");
    $statement->bindParam(':MCN', $_POST["MCN"]);
    $statement->bindParam(':date', $_POST["date"]);
    $statement->bindParam(':startTime', $_POST["startTime"]);
    $statement->bindParam(':endTime', $_POST["endTime"]);
    $statement->execute();

        if ($statement->rowCount() > 0) {
            // If there are any conflicting schedules for the reference_number
            echo "A schedule with conflicting time already exists for this reference number.";
        }
        else {
            $statement = $conn->prepare("INSERT INTO schedule (reference_number, MCN, date, name, startTime, endTime )
            VALUES(:reference_number, :MCN, :date, :name, :startTime, :endTime)");


            $statement->bindParam(':MCN', $_POST["MCN"]);
            $statement->bindParam(':name', $_POST["name"]);
            $statement->bindParam(':date', $_POST["date"]);
            $statement->bindParam(':startTime', $_POST["startTime"]);
            $statement->bindParam(':endTime', $_POST["endTime"]);
            $statement->bindParam(':reference_number', $_POST["reference_number"]);
            $statement->execute();

            header("Location: ./index.php"); //If succsessful, bring the user to the previous location

        }




}
?>