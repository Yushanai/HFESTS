<?php require_once '../../database.php';

$statement = $conn->prepare('SELECT*FROM employees');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Information Of Employees</h1>
    <a href="./create.php">Add a  employees</a>
    <table>
        <thead>
            <tr>
                <td>MCN</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Date of birth</td>
                <td>Telephone number</td>
                <td>Address</td>
                <td>City</td>
                <td>Province</td>
                <td>Postal code</td>
                <td>citizenship</td>
                <td>Email address</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["MCN"] ?></td>
                <td><?= $row["first_name"] ?></td>
                <td><?= $row["last_name"] ?></td>
                <td><?= $row["date_of_birth"] ?></td>
                <td><?= $row["telephone_number"] ?></td>
                <td><?= $row["address"] ?></td>
                <td><?= $row["city"] ?></td>
                <td><?= $row["province"] ?></td>
                <td><?= $row["postal_code"] ?></td>
                <td><?= $row["citizenship"] ?></td>
                <td><?= $row["email_address"] ?></td>
                <td>
                    <button type="submit"><a href="./edit.php?MCN=<?=$row["MCN"]?>">Edit</a></button>
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')"><a href="./delete.php?MCN=<?=$row["MCN"]?>">Delete</a></button>
                    
                    
                </td> 
            </tr>
            <?php  } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>