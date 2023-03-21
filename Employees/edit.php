<?php require_once '../database.php';

$statement = $conn->prepare("SELECT* FROM employees AS employee WHERE employee.MCN = :MCN ");
$statement->bindParam(":MCN", $_GET["MCN"]);
$statement->execute();
$employees = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["MCN"]) 
    && isset($_POST["first_name"]) 
    && isset($_POST["last_name"]) 
    && isset($_POST["date_of_birth"]) 
    && isset($_POST["telephone_number"]) 
    && isset($_POST["address"]) 
    && isset($_POST["city"]) 
    && isset($_POST["province"]) 
    && isset($_POST["postal_code"]) 
    && isset($_POST["citizenship"]) 
    && isset($_POST["email_address"]))
    {
        $statement =  $conn->prepare("UPDATE employees SET first_name=:first_name, last_name=:last_name, date_of_birth=:date_of_birth, 
                                        telephone_number=:telephone_number, address=:address, city=:city, province=:province, postal_code=:postal_code, 
                                        citizenship=:citizenship, email_address=:email_address
                                        WHERE MCN = :MCN;");

        $statement->bindParam(':MCN', $_POST["MCN"]);
        $statement->bindParam(':first_name', $_POST["first_name"]);
        $statement->bindParam(':last_name', $_POST["last_name"]);
        $statement->bindParam(':date_of_birth', $_POST["date_of_birth"]);
        $statement->bindParam(':telephone_number', $_POST["telephone_number"]);
        $statement->bindParam(':address', $_POST["address"]);
        $statement->bindParam(':city', $_POST["city"]);
        $statement->bindParam(':province', $_POST["province"]);
        $statement->bindParam(':postal_code', $_POST["postal_code"]);
        $statement->bindParam(':citizenship', $_POST["citizenship"]);
        $statement->bindParam(':email_address', $_POST["email_address"]);

       
        if( $statement->execute()){
            header("Location: index.php"); //If succsessful, bring the user to the previous location
            exit;
        }
        

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employees</title>
</head>
<body>
    <h1>Edit Employees</h1>
    <form action="./create.php" method = "post">
        <label for="MCN">MCN number</label><br>
        <input type="number" name="MCN" id="MCN" value="<?=$employees["MCN"]?>"> <br>
        <label for="first_name">First name</label><br>
        <input type="text" name="first_name" id="first_name" value="<?=$employees["first_name"]?>"> <br>
        <label for="last_name">Last name</label><br>
        <input type="text" name="last_name" id="last_name" value="<?=$employees["last_name"]?>"> <br>
        <label for="date_of_birth">Date of birth</label><br>
        <input type="date" name="date_of_birth" id="date_of_birth" value="<?=$employees["date_of_birth"]?>"> <br>
        <label for="telephone_number">Telephone number</label><br>
        <input type="text" name="telephone_number" id="telephone_number" value="<?=$employees["telephone_number"]?>"> <br>
        <label for="address">address</label><br>
        <input type="text" name="address" id="address" value="<?=$employees["address"]?>"> <br>
        <label for="city">City</label><br>
        <input type="text" name="city" id="city" value="<?=$employees["city"]?>"> <br>
        <label for="province">Province</label><br>
        <input type="text" name="province" id="province" value="<?=$employees["province"]?>"> <br>
        <label for="postal_code">Postal code</label><br>
        <input type="text" name="postal_code" id="postal_code" value="<?=$employees["postal_code"]?>"> <br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name="citizenship" id="citizenship" value="<?=$employees["citizenship"]?>"> <br>
        <label for="email_address">Email address</label><br>
        <input type="text" name="email_address" id="email_address" value="<?=$employees["email_address"]?>"> <br>

        <button type = "submit">Update </button>
    </form>
    <a href="./">Back to Employees</a>
</body>
</html>