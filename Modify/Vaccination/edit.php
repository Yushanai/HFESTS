<?php require_once '../../database.php';
 
$statement = $conn->prepare("SELECT* FROM vaccination WHERE MCN = :MCN ");
$statement->bindParam(":MCN", $_GET["MCN"]);
$statement->execute();
$infection = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["MCN"]) 
&& isset($_POST["location"]) 
&& isset($_POST["type"]) 
&& isset($_POST["dose"]) 
&& isset($_POST["date"]) 
)

    {
        $statement = $conn->prepare("UPDATE vaccination SET location=:location, type=:type, dose=:dose, 
        date=:date WHERE MCN =:MCN;");

        $statement->bindParam(':MCN', $_POST["MCN"]);
        $statement->bindParam(':location', $_POST["location"]);
        $statement->bindParam(':type', $_POST["type"]);
        $statement->bindParam(':dose', $_POST["dose"]);
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