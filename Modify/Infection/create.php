<?php require_once '../../database.php';

if(isset($_POST["MCN"]) 
&& isset($_POST["type"]) 
&& isset($_POST["times"]) 
&& isset($_POST["date"]) 
)

    {
        $statement =  $conn->prepare("INSERT INTO infection_history (MCN, type, times, date)
            VALUES(:MCN, :type, :times, :date)");

        $statement->bindParam(':MCN', $_POST["MCN"]);
        $statement->bindParam(':type', $_POST["type"]);
        $statement->bindParam(':times', $_POST["times"]);
        $statement->bindParam(':date', $_POST["date"]);
       
        if( $statement->execute()){
            header("Location: ../index.php"); //If succsessful, bring the user to the previous location
            exit;
        }
        

}
?>