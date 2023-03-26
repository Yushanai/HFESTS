<?php require_once '../../database.php';


if(isset($_POST["MCN"]) 
&& isset($_POST["location"]) 
&& isset($_POST["type"]) 
&& isset($_POST["dose"]) 
&& isset($_POST["date"]) 
)

    {
        $statement =  $conn->prepare("INSERT INTO vaccination (MCN, location, type, dose, date)
            VALUES(:MCN, :location, :type, :dose, :date)");
            $statement->bindParam(':MCN', $_POST["MCN"]);
            $statement->bindParam(':location', $_POST["location"]);
            $statement->bindParam(':type', $_POST["type"]);
            $statement->bindParam(':dose', $_POST["dose"]);
            $statement->bindParam(':date', $_POST["date"]);
       
        if( $statement->execute()){
            header("Location: ../index.php"); //If succsessful, bring the user to the previous location
            exit;
        }
        

}
?>