<?php require_once '../database.php';

$Employee = $conn->prepare('SELECT*FROM employees');
$Employee->execute();
$Facility = $conn->prepare('SELECT*FROM facilities');
$Facility->execute();
$Vaccination = $conn->prepare('SELECT*FROM vaccination');
$Vaccination->execute();
$Infection = $conn->prepare('SELECT*FROM infection_history');
$Infection->execute();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.png" type="MIME">

    <!-- Bootstrap CSS -->
    <!-- build:css css/main.css-->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="../css/styles.css">

    <!-- endbuild -->
    <title>Modify</title>
</head>

<body>
    <!--------------------navigation bar---------------------->
    <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto " href="../index.php"><img src="../img/logo.png" height="30" width="41"
                    class="img-fluid"></a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link fa-lg" href="../index.php"> <span
                                class="fa fa-hospital-o "></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="./index.php"><span
                                class="fa fa-pencil  "></span>Modify</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="information/index.php"><span
                                class="fa fa-info "></span>Infomation</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="schedule/index.php"><span
                                class="fa fa-calendar-o "></span>Schedule</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="email/index.php"><span
                                class="fa fa-envelope-o  "></span>Email</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-------------------------------jumbotron---------------------------------->
    <header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-12 col-sm-6 ">
                    <h1>Modify</h1>
                    <h5>With Modify, you can easily create, delete, edit, and display a facility, employee, vaccination,
                        or infection record with just a few clicks. Its intuitive and user-friendly interface makes
                        it easy for anyone to use, and its robust feature set ensures that you have all the tools you
                        need to manage your data effectively. Try Modify today and experience the power of streamlined
                        data management!</h5>
                </div>
                <div class="col-12 col-sm align-items-center">
                    <img src="../img/logo.png" class="image-fluid">

                </div>
            </div>
        </div>
    </header>
    <!-------------------------------jumbotron end---------------------------------->
    <!-------------------------------Content---------------------------------->
    <div class="row row-content align-items-center">
        <div class="col-12">
            <h2>Please select the part you would like to operate on.</h2>
            <!--Accordion-->
            <div id="accordion">
                <!------------------------------------------------------------Employees---------------------------------->
                <div class="card">
                    <div class="card-header" role="tab" id="Employeehead">
                        <div class="d-flex">
                            <h3 class="mb-0">
                                <a data-toggle="collapse" data-target="#Employee">
                                    Employee <small>Create/Delete/Edit/Display a Employee</small>
                                </a>
                            </h3>
                            <!--Create button-->
                            <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                data-target="#createEmployees">
                                <a style="font-weight:bold; color: black">Create</a>
                            </button>
                        </div>
                    </div>
                    <!-- Button modal Content -->
                    <div id="createEmployees" class="modal fade" role="dialog" style="color:black ;">
                        <div class="modal-dialog modal-lg" role="content">
                            <div class="modal-content">
                                <div class="modal-header" style="background:#3e94f1 ;">
                                    <h4 class="modal-title">Create Employees</h4>
                                    <button type="button" class="close" data-dismiss="modal">
                                        &times;
                                    </button>
                                </div>
                                <div class="modal-body" style="background:floralwhite ;">
                                    <form class="form-group" id="create-Employee" action="Employees/create.php"
                                        method="post">
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
                                        <input type="text" name="email_address" id="email_address"> <br><br><br>
                                </div>
                                <div class="modal-footer" style="background:#3e94f1;">
                                    <div class="offset-md-2 col-md-10">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="show" id="Employee" data-parent="#accordion">
                        <!----------------------table for employees--------------------------------------->
                        <div class="card-body">
                            <!--table for employees-->
                            <div class="col-12 col-sm-9">
                                <div class="table-responsive">
                                    <!--table can scroll horizontally when using small screen devices-->
                                    <table class="table table-striped">
                                        <!--striped: design a table with alternate rows in different colors-->
                                        <thead class="thead-dark">
                                            <!--render the head dark-->

                                            <th>MCN</th>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Date of birth</th>
                                            <th>Telephone number</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Postal code</th>
                                            <th>citizenship</th>
                                            <th>Email address</th>
                                            <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $Employee->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
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
                                                    <!--edit button-->

                                                    <button type="submit" class="btn btn-primary btn-sm w-100"
                                                        data-toggle="modal" data-target="#editEmployees">
                                                        <a style="font-weight:bold; color: black">Edit
                                                        </a>
                                                    </button>



                                                    <!-- Button modal Content -->
                                                    <div id="editEmployees" class="modal fade" role="dialog"
                                                        style="color:black ;">
                                                        <div class="modal-dialog modal-lg" role="content">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background:#3e94f1 ;">
                                                                    <h4 class="modal-title">Edit Employees</h4>
                                                                    <button type="submit" class="close"
                                                                        data-dismiss="modal">
                                                                        &times;
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body"
                                                                    style="background:floralwhite ;">
                                                                    <form class="form-group" id="edit-Employee"
                                                                        action="Employees/edit.php" method="post">
                                                                        <label for="MCN">MCN number</label><br>
                                                                        <input type="number" name="MCN" id="MCN"> <br>
                                                                        <label for="first_name">First name</label><br>
                                                                        <input type="text" name="first_name"
                                                                            id="first_name"> <br>
                                                                        <label for="last_name">Last name</label><br>
                                                                        <input type="text" name="last_name"
                                                                            id="last_name"> <br>
                                                                        <label for="date_of_birth">Date of
                                                                            birth</label><br>
                                                                        <input type="date" name="date_of_birth"
                                                                            id="date_of_birth"> <br>
                                                                        <label for="telephone_number">Telephone
                                                                            number</label><br>
                                                                        <input type="text" name="telephone_number"
                                                                            id="telephone_number"> <br>
                                                                        <label for="address">address</label><br>
                                                                        <input type="text" name="address" id="address">
                                                                        <br>
                                                                        <label for="city">City</label><br>
                                                                        <input type="text" name="city" id="city"> <br>
                                                                        <label for="province">Province</label><br>
                                                                        <input type="text" name="province"
                                                                            id="province"> <br>
                                                                        <label for="postal_code">Postal code</label><br>
                                                                        <input type="text" name="postal_code"
                                                                            id="postal_code"> <br>
                                                                        <label for="citizenship">Citizenship</label><br>
                                                                        <input type="text" name="citizenship"
                                                                            id="citizenship"> <br>
                                                                        <label for="email_address">Email
                                                                            address</label><br>
                                                                        <input type="text" name="email_address"
                                                                            id="email_address"> <br><br><br>
                                                                </div>
                                                                <div class="modal-footer" style="background:#3e94f1;">
                                                                    <div class="offset-md-2 col-md-10">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Edit</button>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--delete button-->
                                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                                        onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <a href="Employees/delete.php?MCN=<?=$row["MCN"]?>"
                                                            style="font-weight:bold; color: black">Delete
                                                        </a>
                                                    </button>


                                                </td>
                                            </tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!------------------------------------------------------------Employees end---------------------------------->

                    <!------------------------------------------------------------Facility ---------------------------------->

                    <div class="card">
                        <div class="card-header" role="tab" id="Facilityhead">
                            <div class="d-flex">
                                <h3 class="mb-0">
                                    <a data-toggle="collapse" data-target="#Facility">
                                        Facility<small>Create/Delete/Edit/Display a Facility</small>
                                    </a>
                                </h3>
                                <!--Create button-->
                                <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                    data-target="#createFacility">
                                    <a style="font-weight:bold; color: black">Create</a>
                                </button>
                            </div>
                        </div>
                        <!-- Button modal Content -->
                        <div id="createFacility" class="modal fade" role="dialog" style="color:black ;">
                            <div class="modal-dialog modal-lg" role="content">
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#3e94f1 ;">
                                        <h4 class="modal-title">Create Facility</h4>
                                        <button type="button" class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body" style="background:floralwhite ;">
                                        <form class="form-group" id="create-Facility" action="Facility/create.php"
                                            method="post">
                                            <label for="name">Name</label><br>
                                            <input type="text" name="name" id="name"> <br>
                                            <label for="address">Address</label><br>
                                            <input type="text" name="address" id="address"> <br>
                                            <label for="city">City</label><br>
                                            <input type="text" name="city" id="city"> <br>
                                            <label for="province">Province</label><br>
                                            <input type="text" name="province" id="province"> <br>
                                            <label for="postal_code">Postal code</label><br>
                                            <input type="text" name="postal_code" id="postal_code"> <br>
                                            <label for="phone_number">Phone number</label><br>
                                            <input type="text" name="phone_number" id="phone_number"> <br>
                                            <label for="web_address">Web address</label><br>
                                            <input type="text" name="web_address" id="web_address"> <br>
                                            <label for="type">Type</label><br>
                                            <input type="text" name="type" id="type"> <br>
                                            <label for="capacity">Capacity</label><br>
                                            <input type="text" name="capacity" id="capacity"> <br>
                                    </div>
                                    <div class="modal-footer" style="background:#3e94f1;">
                                        <div class="offset-md-2 col-md-10">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="collapse" id="Facility" data-parent="#accordion">

                            <div class="card-body">
                                <div class="col-12 col-sm-9">
                                    <div class="table-responsive">
                                        <!--table can scroll horizontally when using small screen devices-->
                                        <table class="table table-striped">
                                            <!--striped: design a table with alternate rows in different colors-->
                                            <thead class="thead-dark">
                                                <!--render the head dark-->

                                                <th>Name </th>
                                                <th>Address </th>
                                                <th>City</th>
                                                <th>Province</th>
                                                <th>Postal code</th>
                                                <th>Phone number</th>
                                                <th>Web Address</th>
                                                <th>Type</th>
                                                <th>Capacity</th>
                                                <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $Facility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                                <tr>
                                                    <td><?= $row["name"] ?></td>
                                                    <td><?= $row["address"] ?></td>
                                                    <td><?= $row["city"] ?></td>
                                                    <td><?= $row["province"] ?></td>
                                                    <td><?= $row["postal_code"] ?></td>
                                                    <td><?= $row["phone_number"] ?></td>
                                                    <td><?= $row["web_address"] ?></td>
                                                    <td><?= $row["type"] ?></td>
                                                    <td><?= $row["capacity"] ?></td>
                                                    <td>
                                                        <!--edit button-->
                                                        <button type="submit" class="btn btn-primary btn-sm w-100"
                                                            data-toggle="modal" data-target="#editFacilities">
                                                            <a style="font-weight:bold; color: black">Edit
                                                            </a>
                                                        </button>
                                                        <!-- Button modal Content -->
                                                        <div id="editFacilities" class="modal fade" role="dialog"
                                                            style="color:black ;">
                                                            <div class="modal-dialog modal-lg" role="content">
                                                                <div class="modal-content">
                                                                    <div class="modal-header"
                                                                        style="background:#3e94f1 ;">
                                                                        <h4 class="modal-title">Edit Facilities</h4>
                                                                        <button type="submit" class="close"
                                                                            data-dismiss="modal">
                                                                            &times;
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="background:floralwhite ;">
                                                                        <form class="form-group" id="edit-Facility"
                                                                            action="Facility/edit.php" method="post">
                                                                            <label for="name">Name</label><br>
                                                                            <input type="text" name="name" id="name">
                                                                            <br>
                                                                            <label for="address">Address</label><br>
                                                                            <input type="text" name="address"
                                                                                id="address"> <br>
                                                                            <label for="city">City</label><br>
                                                                            <input type="text" name="city" id="city">
                                                                            <br>
                                                                            <label for="province">Province</label><br>
                                                                            <input type="text" name="province"
                                                                                id="province"> <br>
                                                                            <label for="postal_code">Postal
                                                                                code</label><br>
                                                                            <input type="text" name="postal_code"
                                                                                id="postal_code"> <br>
                                                                            <label for="phone_number">Phone
                                                                                number</label><br>
                                                                            <input type="text" name="phone_number"
                                                                                id="phone_number"> <br>
                                                                            <label for="web_address">Web
                                                                                address</label><br>
                                                                            <input type="text" name="web_address"
                                                                                id="web_address"> <br>
                                                                            <label for="type">Type</label><br>
                                                                            <input type="text" name="type" id="type">
                                                                            <br>
                                                                            <label for="capacity">Capacity</label><br>
                                                                            <input type="text" name="capacity"
                                                                                id="capacity"> <br>

                                                                    </div>
                                                                    <div class="modal-footer"
                                                                        style="background:#3e94f1;">
                                                                        <div class="offset-md-2 col-md-10">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Edit</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--delete button-->
                                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <a href="Facility/delete.php?name=<?=$row["name"]?>"
                                                                style="font-weight:bold; color: black">Delete
                                                            </a>
                                                        </button>


                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------Facility end ---------------------------------->

                    <!------------------------------------------------------------Vaccination ---------------------------------->
                    <div class="card">
                        <div class="card-header" role="tab" id="Vaccinationhead">
                            <div class="d-flex">
                                <h3 class="mb-0">
                                    <a data-toggle="collapse" data-target="#Vaccination">
                                        Vaccination <small>Create/Delete/Edit/Display a Vaccination</small>
                                    </a>
                                </h3>
                                <!--Create button-->
                                <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                    data-target="#createVaccination">
                                    <a style="font-weight:bold; color: black">Create</a>
                                </button>
                            </div>
                        </div>
                        <!-- Button modal Content -->
                        <div id="createVaccination" class="modal fade" role="dialog" style="color:black ;">
                            <div class="modal-dialog modal-lg" role="content">
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#3e94f1 ;">
                                        <h4 class="modal-title">Create Vaccination</h4>
                                        <button type="button" class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body" style="background:floralwhite ;">
                                        <form class="form-group" id="create-Vaccination" action="Vaccination/create.php"
                                            method="post">
                                            <label for="MCN">MCN</label><br>
                                            <input type="number" name="MCN" id="MCN"> <br>
                                            <label for="location">Location</label><br>
                                            <input type="text" name="location" id="location"> <br>
                                            <label for="type">Type</label><br>
                                            <input type="text" name="type" id="type"> <br>
                                            <label for="dose">Dose</label><br>
                                            <input type="number" name="dose" id="dose"> <br>
                                            <label for="date">Date</label><br>
                                            <input type="date" name="date" id="date"> <br>

                                    </div>
                                    <div class="modal-footer" style="background:#3e94f1;">
                                        <div class="offset-md-2 col-md-10">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                        <!--</div> -->

                        <div role="tabpanel" class="collapse" id="Vaccination" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-12 col-sm-9">
                                    <div class="table-responsive">
                                        <!--table can scroll horizontally when using small screen devices-->
                                        <table class="table table-striped">
                                            <!--striped: design a table with alternate rows in different colors-->
                                            <thead class="thead-dark">
                                                <!--render the head dark-->

                                                <th>MCN </th>
                                                <th>Location </th>
                                                <th>Type</th>
                                                <th>Dose</th>
                                                <th>Date</th>
                                                <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $Vaccination->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                                <tr>
                                                    <td><?= $row["MCN"] ?></td>
                                                    <td><?= $row["location"] ?></td>
                                                    <td><?= $row["type"] ?></td>
                                                    <td><?= $row["dose"] ?></td>
                                                    <td><?= $row["date"] ?></td>
                                                    <td>
                                                        <!--edit button-->
                                                        <button type="submit" class="btn btn-primary btn-sm w-100"
                                                            data-toggle="modal" data-target="#editVaccination">
                                                            <a style="font-weight:bold; color: black">Edit
                                                            </a>
                                                        </button>
                                                        <!-- Button modal Content -->
                                                        <div id="editVaccination" class="modal fade" role="dialog"
                                                            style="color:black ;">
                                                            <div class="modal-dialog modal-lg" role="content">
                                                                <div class="modal-content">
                                                                    <div class="modal-header"
                                                                        style="background:#3e94f1 ;">
                                                                        <h4 class="modal-title">Edit Vaccination</h4>
                                                                        <button type="submit" class="close"
                                                                            data-dismiss="modal">
                                                                            &times;
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="background:floralwhite ;">
                                                                        <form class="form-group" id="edit-Facility"
                                                                            action="Vaccination/edit.php" method="post">
                                                                            <label for="MCN">MCN</label><br>
                                                                            <input type="number" name="MCN" id="MCN">
                                                                            <br>
                                                                            <label for="location">Location</label><br>
                                                                            <input type="text" name="location"
                                                                                id="location"> <br>
                                                                            <label for="type">Type</label><br>
                                                                            <input type="text" name="type" id="type">
                                                                            <br>
                                                                            <label for="dose">Dose</label><br>
                                                                            <input type="number" name="dose" id="dose">
                                                                            <br>
                                                                            <label for="date">Date</label><br>
                                                                            <input type="date" name="date" id="date">
                                                                            <br>

                                                                    </div>
                                                                    <div class="modal-footer"
                                                                        style="background:#3e94f1;">
                                                                        <div class="offset-md-2 col-md-10">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Edit</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--delete button-->
                                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <a href="Vaccination/delete.php?MCN=<?=$row["MCN"]?>"
                                                                style="font-weight:bold; color: black">Delete
                                                            </a>
                                                        </button>


                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------------------------------------------infection_history-------------------------------------------------->
                    <div class="card">
                        <div class="card-header" role="tab" id="Infectionhead">
                            <div class="d-flex">
                                <h3 class="mb-0">
                                    <a data-toggle="collapse" data-target="#Infection">
                                        Infection<small>Create/Delete/Edit/Display an Infection</small>
                                    </a>
                                </h3>
                                <!--Create button-->
                                <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                    data-target="#createInfection">
                                    <a style="font-weight:bold; color: black">Create</a>
                                </button>
                            </div>
                        </div>
                        <!-- Button modal Content -->
                        <div id="createInfection" class="modal fade" role="dialog" style="color:black ;">
                            <div class="modal-dialog modal-lg" role="content">
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#3e94f1 ;">
                                        <h4 class="modal-title">Create Infection</h4>
                                        <button type="button" class="close" data-dismiss="modal">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="modal-body" style="background:floralwhite ;">
                                        <form class="form-group" id="create-Infection" action="Infection/create.php"
                                            method="post">
                                            <label for="MCN">MCN</label><br>
                                            <input type="number" name="MCN" id="MCN"> <br>
                                            <label for="type">Type</label><br>
                                            <input type="text" name="type" id="type"> <br>
                                            <label for="times">Times</label><br>
                                            <input type="number" name="times" id="times"> <br>
                                            <label for="date">Date</label><br>
                                            <input type="date" name="date" id="date"> <br>

                                    </div>
                                    <div class="modal-footer" style="background:#3e94f1;">
                                        <div class="offset-md-2 col-md-10">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                        <!--</div> -->

                        <div role="tabpanel" class="collapse" id="Infection" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-12 col-sm-9">
                                    <div class="table-responsive">
                                        <!--table can scroll horizontally when using small screen devices-->
                                        <table class="table table-striped">
                                            <!--striped: design a table with alternate rows in different colors-->
                                            <thead class="thead-dark">
                                                <!--render the head dark-->

                                                <th>MCN </th>
                                                <th>Type</th>
                                                <th>Times</th>
                                                <th>Date</th>
                                                <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $Infection->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                                <tr>
                                                    <td><?= $row["MCN"] ?></td>
                                                    <td><?= $row["type"] ?></td>
                                                    <td><?= $row["times"] ?></td>
                                                    <td><?= $row["date"] ?></td>
                                                    <td>
                                                        <!--edit button-->
                                                        <button type="submit" class="btn btn-primary btn-sm w-100"
                                                            data-toggle="modal" data-target="#editInfection ">
                                                            <a style="font-weight:bold; color: black">Edit
                                                            </a>
                                                        </button>
                                                        <!-- Button modal Content -->
                                                        <div id="editInfection" class="modal fade" role="dialog"
                                                            style="color:black ;">
                                                            <div class="modal-dialog modal-lg" role="content">
                                                                <div class="modal-content">
                                                                    <div class="modal-header"
                                                                        style="background:#3e94f1 ;">
                                                                        <h4 class="modal-title">Edit Infection</h4>
                                                                        <button type="submit" class="close"
                                                                            data-dismiss="modal">
                                                                            &times;
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="background:floralwhite ;">
                                                                        <form class="form-group" id="edit-Facility"
                                                                            action="Infection/edit.php" method="post">
                                                                            <label for="MCN">MCN</label><br>
                                                                            <input type="number" name="MCN" id="MCN">
                                                                            <br>
                                                                            <label for="type">Type</label><br>
                                                                            <input type="text" name="type" id="type">
                                                                            <br>
                                                                            <label for="times">Times</label><br>
                                                                            <input type="number" name="times" id="times">
                                                                            <br>
                                                                            <label for="date">Date</label><br>
                                                                            <input type="date" name="date" id="date">
                                                                            <br>
                                                                    </div>
                                                                    <div class="modal-footer"
                                                                        style="background:#3e94f1;">
                                                                        <div class="offset-md-2 col-md-10">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Edit</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--delete button-->
                                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                                            <a href="Infection/delete.php?MCN=<?=$row["MCN"]?>"
                                                                style="font-weight:bold; color: black">Delete
                                                            </a>
                                                        </button>


                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!--------------------------------------------------------------------------------------------------->



    <!--------------------------------------------------------------------------------------------------->

    <footer class="footer ">
        <div class="container">
            <div class="row">
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="./index.php">Modify</a></li>
                        <li><a href="./information.php">Infomation</a></li>
                        <li><a href="./schedule.php">Schedule</a></li>
                        <li><a href="./email.php">Email</a></li>
                    </ul>
                </div>
                <div class="col-7 col-sm-5">
                    <h5>Our Address</h5>
                    <address>
                        1455 Boul. de Maisonneuve Ouest<br>
                        QC H3G 1M8<br>
                        Montréal<br>
                        <i class="fa fa-phone fa-lg"></i>: +1 438 888 8888<br>
                        <i class="fa fa-fax fa-lg"></i>: +1 512 111 2222<br>
                        <i class="fa fa-envelope fa-lg"></i>:
                        <a href="mailto:HFESTS@gmail.com">HFESTS@gmail.com</a>
                    </address>
                </div>
                <div class="col-12 col-sm-4 align-self-center">
                    <div class="text-center">
                        <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i
                                class="fa fa-google-plus"></i></a>
                        <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i
                                class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i
                                class="fa fa-linkedin"></i></a>
                        <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i
                                class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i
                                class="fa fa-youtube"></i></a>
                        <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope-o"></i></a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <p>© Copyright 2023 Health Facility Employee Status Tracking System</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS. -->

    <script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/da57742d83.js" crossorigin="anonymous"></script>

</body>

</html>