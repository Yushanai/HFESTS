<?php require_once '../../database.php';
 
$statement = $conn->prepare("SELECT* FROM infection_history WHERE MCN = :MCN ");
$statement->bindParam(":MCN", $_GET["MCN"]);
$statement->execute();
$infection = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["MCN"]) 
&& isset($_POST["type"]) 
&& isset($_POST["times"]) 
&& isset($_POST["date"]) 
)

    {
        $statement = $conn->prepare("UPDATE infection_history SET type=:type, times=:times, 
        date=:date WHERE MCN =:MCN;");

        $statement->bindParam(':MCN', $_POST["MCN"]);
        $statement->bindParam(':type', $_POST["type"]);
        $statement->bindParam(':times', $_POST["times"]);
        $statement->bindParam(':date', $_POST["date"]);


       
    }
        

//}
if ($statement->execute()) {
    // Query executed successfully
        header("Location: ../index.php"); //If succsessful, bring the user to the previous location
       // exit;
} 
else {
    // Handle error
    echo "Failed to update infection history";
}

?>