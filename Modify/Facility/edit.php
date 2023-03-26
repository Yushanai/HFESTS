<?php require_once '../../database.php';
 
$statement = $conn->prepare("SELECT* FROM facilities  AS facility WHERE facility.name = :name ");
$statement->bindParam(":name", $_GET["name"]);
$statement->execute();
$facilities = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["name"]) 
    && isset($_POST["address"]) 
    && isset($_POST["city"]) 
    && isset($_POST["province"]) 
    && isset($_POST["postal_code"]) 
    && isset($_POST["phone_number"])  
    && isset($_POST["web_address"]) 
    && isset($_POST["type"]) 
    && isset($_POST["capacity"])
)
    {
        $statement = $conn->prepare("UPDATE facilities SET address=:address, city=:city, 
        province=:province, postal_code=:postal_code, phone_number=:phone_number,  web_address=:web_address, type=:type, capacity=:capacity 
       WHERE name =:name;");

        $statement->bindParam(':name', $_POST["name"]);
        $statement->bindParam(':address', $_POST["address"]);
        $statement->bindParam(':city', $_POST["city"]);
        $statement->bindParam(':province', $_POST["province"]);
        $statement->bindParam(':postal_code', $_POST["postal_code"]);
        $statement->bindParam(':phone_number', $_POST["phone_number"]);
        $statement->bindParam(':web_address', $_POST["web_address"]);
        $statement->bindParam(':type', $_POST["type"]);
        $statement->bindParam(':capacity', $_POST["capacity"]);


       
    }
        

//}
if ($statement->execute()) {
    // Query executed successfully
        header("Location: ../index.php"); //If succsessful, bring the user to the previous location
       // exit;
} 
else {
    // Handle error
    echo "Failed to update facility";
}

?>