<?php require_once '../../database.php';

if(isset($_POST["name"]) 
&& isset($_POST["address"]) 
&& isset($_POST["city"]) 
&& isset($_POST["province"]) 
&& isset($_POST["postal_code"]) 
&& isset($_POST["phone_number"]) 
&& isset($_POST["web_address"]) 
&& isset($_POST["type"]) 
&& isset($_POST["capacity"]))

    {
        $statement =  $conn->prepare("INSERT INTO facilities (name, address, city, province, postal_code, phone_number, web_address, type, capacity)
            VALUES(:name, :address, :city, :province, :postal_code,:phone_number, :web_address, :type, :capacity)");

        $statement->bindParam(':name', $_POST["name"]);
        $statement->bindParam(':address', $_POST["address"]);
        $statement->bindParam(':city', $_POST["city"]);
        $statement->bindParam(':province', $_POST["province"]);
        $statement->bindParam(':postal_code', $_POST["postal_code"]);
        $statement->bindParam(':phone_number', $_POST["phone_number"]);
        $statement->bindParam(':web_address', $_POST["web_address"]);
        $statement->bindParam(':type', $_POST["type"]);
        $statement->bindParam(':capacity', $_POST["capacity"]);
       
        if( $statement->execute()){
            header("Location: ../index.php"); //If succsessful, bring the user to the previous location
            exit;
        }
        

}
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./create.php" method = "post">
        <label for="MCN">MCN number</label><br>
        <input type="number" name="MCN" id="MCN"> <br>
        <label for="first_name">First name</label><br>
        <input type="text" name="first_name" id="first_name"> <br>
        <label for="last_name">Last name</label><br>
        <input type="text" name="last_name" id="last_name"> <br>
        <label for="date_of_birth">Date of birth</label><br>
        <input type="date" name="date_of_birth" id="date_of_birth"> <br>
        <label for="telephone_number">Telephone number</label><br>
        <input type="text" name="telephone_number" id="telephone_number"> <br>
        <label for="address">address</label><br>
        <input type="text" name="address" id="address"> <br>
        <label for="city">City</label><br>
        <input type="text" name="city" id="city"> <br>
        <label for="province">Province</label><br>
        <input type="text" name="province" id="province"> <br>
        <label for="postal_code">Postal code</label><br>
        <input type="text" name="postal_code" id="postal_code"> <br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name="citizenship" id="citizenship"> <br>
        <label for="email_address">Email address</label><br>
        <input type="text" name="email_address" id="email_address"> <br>
        <button type = "submit">Add </button>
    </form>
    <a href="./">Back to Employees</a>
</body>
</html> -->