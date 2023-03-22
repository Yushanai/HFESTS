<?php require_once '../database.php';

$statement = $conn->prepare('SELECT*FROM employees');
$statement->execute();
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
                    <li class="nav-item"><a class="nav-link fa-lg" href="../index.php"> <span class="fa fa-hospital-o "></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="./index.php"><span class="fa fa-pencil  "></span>Modify</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="../information.php"><span class="fa fa-info "></span>Infomation</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="../schedule.php"><span class="fa fa-calendar-o "></span>Schedule</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="../email.php"><span class="fa fa-envelope-o  "></span>Email</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-------------------------------jumbotron---------------------------------->
    <header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-12 col-sm-6 ">
                    <h1>Health Facility Employee Status Tracking System</h1>
                    <h5>The HFESTS system help health care facilities to
                        keep track of their employees’ health status during the COVID-19 pandemic.</h5>
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
                        <h3 class="mb-0">
                            <a data-toggle="collapse" data-target="#Employee">
                                Employee <small>Create/Delete/Edit/Display a Employee</small>
                            </a>
                        </h3>
                    </div>

                    <div role="tabpanel" class="show" id="Employee" data-parent="#accordion">
                        <div class="card-body"><!--table for employees-->
                            <div class="col-12 col-sm-9">
                            <div class="table-responsive"> <!--table can scroll horizontally when using small screen devices-->
                                <table class="table table-striped"> <!--striped: design a table with alternate rows in different colors-->
                                    <thead class="thead-dark"> <!--render the head dark-->
                                        
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
                                        <!--edit button-->
                                        <button type="button" class="btn btn-primary btn-sm w-100" 
                                                data-toggle="modal"  data-target="#editEmployees"> 
                                                <a href="Employees/edit.php?MCN=<?=$row["MCN"]?>"
                                                style="font-weight:bold; color: black" >Edit
                                                </a>
                                        </button>
                                        <!--delete button-->
                                        <button type="submit" class="btn btn-primary btn-sm w-100" 
                                                onclick="return confirm('Are you sure you want to delete this record?')"
                                                style="background-color: red; color: white;">
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

                        <h3 class="mb-0">
                            <a data-toggle="collapse" data-target="#Facility">
                                Facility<small>Create/Delete/Edit/Display a Facility</small>
                            </a>
                        </h3>
                    </div>

                    <div role="tabpanel" class="collapse" id="Facility" data-parent="#accordion">
                        <div class="card-body">
                        <div class="col-12 col-sm-9">
               <h2>Dacts &amp; Figures</h2>
               <div class="table-responsive"> <!--table can scroll horizontally when using small screen devices-->
                <table class="table table-striped"> <!--striped: design a table with alternate rows in different colors-->
                    <thead class="thead-dark"><!--render the head dark-->
                        <tr>
                            <th>&nbsp;</th>
                            <th>2013</th>
                            <th>2014</th>
                            <th>2015</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Employees</th>
                            <td>15</td>
                            <td>30</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <th>Guests Served</th>
                            <td>15000</td>
                            <td>45000</td>
                            <td>100,000</td>
                        </tr>
                        <tr>
                            <th>Special Events</th>
                            <td>3</td>
                            <td>20</td>
                            <td>45</td>
                        </tr>
                        <tr>
                            <th>Annual Turnover</th>
                            <td>$251,325</td>
                            <td>$1,250,375</td>
                            <td>~$3,000,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                        </div>
                    </div>
                </div>
                </div>
<!------------------------------------------------------------Facility end ---------------------------------->

                <div class="card">
                    <div class="card-header" role="tab" id="Vaccinationhead">

                        <h3 class="mb-0">
                            <a data-toggle="collapse" data-target="#Vaccination">
                                Vaccination <small>Create/Delete/Edit/Display a Vaccination</small>
                            </a>
                        </h3>
                    </div>

                    <div role="tabpanel" class="collapse" id="Vaccination" data-parent="#accordion">
                        <div class="card-body">
                            <p class="d-none d-sm-block">Blessed with the most discerning gustatory sense,
                                Agumbe, our CTO, personally ensures that every dish that we serve meets his
                                exacting tastes. Our chefs dread the tongue lashing that ensues if their dish
                                does not meet his exacting standards. He lives by his motto, <em>You click
                                    only if you survive my lick.</em></p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="Infectionhead">

                        <h3 class="mb-0">
                            <a data-toggle="collapse" data-target="#Infection">
                                Infection<small>Create/Delete/Edit/Display an Infection</small>
                            </a>
                        </h3>
                    </div>

                        <div role="tabpanel" class="collapse" id="Infection" data-parent="#accordion">
                            <div class="card-body">
                            <p class="d-none d-sm-block">Award winning three-star Michelin chef with wide
                                International experience having worked closely with whos-who in the culinary
                                world, he specializes in creating mouthwatering Indo-Italian fusion experiences.
                                He says, <em>Put together the cuisines from the two craziest cultures, and you
                                    get a winning hit! Amma Mia!</em></p>
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