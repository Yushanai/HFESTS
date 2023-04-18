<?php require_once './../database.php';
//question 6
$facility6 = $conn->prepare("
SELECT 
    f.name, f.address, f.city, f.province, f.postal_code, f.phone_number, f.web_address, f.type, f.capacity,
    CONCAT(e.first_name, ' ', e.last_name) AS general_manager_name,
    COUNT(w.MCN) AS number_of_employees
FROM facilities f
LEFT JOIN workat w ON f.type = w.Ftype AND f.name = w.Fname AND f.address = w.Faddress AND w.end_time IS NULL
LEFT JOIN (SELECT Ftype, Fname, Faddress, MCN FROM workat WHERE role = 'administrative personnel') AS mgr ON f.type = mgr.Ftype AND f.name = mgr.Fname AND f.address = mgr.Faddress
LEFT JOIN employees e ON mgr.MCN = e.MCN
GROUP BY f.name, f.address, f.city, f.province, f.postal_code, f.phone_number, f.web_address, f.type, f.capacity, general_manager_name
ORDER BY f.province ASC, f.city ASC, f.type ASC, number_of_employees ASC;");
$facility6->execute();

//Question7
if (isset($_GET['facility'])) {
    $statement = $conn->prepare("
SELECT e.first_name, e.last_name, w.start_time, e.date_of_birth, e.MCN, e.telephone_number, e.address, e.city, e.province, e.postal_code, e.citizenship, e.email_address
FROM employees e
INNER JOIN workat w ON e.MCN = w.MCN
WHERE w.Fname  = '{$_GET['facility']}' AND w.end_time IS NULL
ORDER BY w.role ASC, e.first_name ASC, e.last_name ASC;");
    $statement->execute();
    $facility7 = $statement->fetchAll(PDO::FETCH_ASSOC);
}
//Question 9
$Facility9=$conn->prepare("SELECT e.first_name, e.last_name, ih.date, w.Fname
FROM employees e
JOIN workat w ON e.MCN = w.MCN
JOIN infection_history ih ON e.MCN = ih.MCN
WHERE w.role = 'Doctor' 
AND ih.type = 'COVID-19' 
AND ih.date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)
ORDER BY w.Fname ASC, e.first_name ASC;");
$Facility9->execute();

//Question 13
$Facility13=$conn->prepare("SELECT f.province, f.name, f.capacity, COUNT(ih.MCN) AS infected_count
FROM facilities f
LEFT JOIN workat w ON f.name = w.Fname AND f.address = w.Faddress AND f.type = w.Ftype
LEFT JOIN infection_history ih ON w.MCN = ih.MCN
WHERE ih.type = 'COVID-19' AND ih.date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)
GROUP BY f.name
ORDER BY f.province ASC, infected_count ASC;");
$Facility13->execute();

//Question14
$Facility14=$conn->prepare("SELECT e.first_name, e.last_name, e.city, COUNT(DISTINCT w.Fname) AS facility_count
FROM employees e
JOIN workat w ON e.MCN = w.MCN
WHERE w.role = 'Doctor' AND w.Faddress IN (
    SELECT address
    FROM facilities
    WHERE province = 'Québec'
) AND (w.end_time IS NULL OR w.end_time > CURRENT_DATE)
GROUP BY e.MCN, e.first_name, e.last_name, e.city
ORDER BY e.city ASC, facility_count DESC;

");
$Facility14->execute();

//Question16
$Facility16=$conn->prepare("SELECT e.first_name, e.last_name, MIN(w.start_time) AS first_day_work, w.role, e.date_of_birth, e.email_address, SUM(TIMESTAMPDIFF(HOUR, s.startTime, s.endTime)) AS total_hours_scheduled
FROM employees e
JOIN workat w ON e.MCN = w.MCN
INNER JOIN schedule s ON e.MCN = s.MCN
WHERE w.role IN ('Nurse', 'Doctor') AND e.MCN IN (
    SELECT MCN
    FROM infection_history
    WHERE type = 'COVID-19' AND times>=3
) AND (w.end_time IS NULL OR w.end_time > CURRENT_DATE)
GROUP BY e.MCN, e.first_name, e.last_name, w.role, e.date_of_birth, e.email_address
ORDER BY w.role ASC, e.first_name ASC, e.last_name ASC;

");
$Facility16->execute();

//Question17
$Facility17=$conn->prepare("SELECT e.first_name, e.last_name, MIN(w.start_time) AS first_day_work, w.role, e.date_of_birth, e.email_address, SUM(TIMESTAMPDIFF(HOUR, s.startTime, s.endTime)) AS total_hours_scheduled
FROM employees e
JOIN workat w ON e.MCN = w.MCN
INNER JOIN schedule s ON e.MCN = s.MCN
WHERE w.role IN ('Nurse', 'Doctor') AND e.MCN NOT IN (
    SELECT MCN
    FROM infection_history
    WHERE type = 'COVID-19'
)
GROUP BY e.MCN, e.first_name, e.last_name, w.role, e.date_of_birth, e.email_address
ORDER BY w.role ASC, e.first_name ASC, e.last_name ASC;


");
$Facility17->execute();
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
    <title>Email</title>
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
                <li class="nav-item"><a class="nav-link fa-lg" href="../Modify/index.php"><span
                            class="fa fa-pencil  "></span>Modify</a></li>
                <li class="nav-item"><a class="nav-link fa-lg" href="./index.php"><span
                            class="fa fa-info "></span>Information</a></li>
                <li class="nav-item"><a class="nav-link fa-lg" href="../Schedule/index.php"><span
                            class="fa fa-calendar-o "></span>Schedule</a></li>
                <li class="nav-item"><a class="nav-link fa-lg" href="../Email/index.php"><span
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
                <h1>Information</h1>
                <h5>By accessing an Information webpage, you can easily view Question 6 7 9 14 15 and 16.</h5>
            </div>
            <div class="col-12 col-sm align-items-center">
                <img src="../img/logo.png" class="image-fluid">

            </div>
        </div>
    </div>
</header>
<!---------------------------Content-------------------------------------------->
<div class="container">
    <div class="row row-content  align-items-center">
        <div class="col-12">
        <h2>Question 6:Details of all the facilities in the system</h2>
        <!--Accordion-->
        <div id="accordion">
            <!------------------------------------------------------------Facilities---------------------------------->
            <div class="card">
                <div class="card-header " role="tab" id="LogTableHead">
                    <div class="d-flex">
                        <h3 class="mb-0">
                            <a data-toggle="collapse" data-target="#FacilityTable">
                                Facilities Table
                            </a>
                    </div>
                </div>
                <!--table for Facilities-->
                <div role="tabpanel" class="show" id="FacilityTable" data-parent="#accordion">
                    <div class="card-body">
                        <div class="col-12 col-sm">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Province</th>
                                    <th>Postal Code</th>
                                    <th>Phone Number</th>
                                    <th>Web Address</th>
                                    <th>Type</th>
                                    <th>Capacity</th>
                                    <th>General Manager</th>
                                    <th>Number of Employees</th>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = $facility6->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
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
                                            <td><?= $row["general_manager_name"] ?></td>
                                            <td><?= $row["number_of_employees"] ?></td>

                                        </tr>
                                    <?php  } ?>
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
<!-------------------------------Get details of all the employees currently working in a specific facility------------------------------------------------->
    <div class="row row-content align-items-center">
        <div class="col-12">
            <h2 class="mt-0">Question 7:Get details of all the employees currently working in a specific facility<span class="badge badge-info">Info</span></h2>
        </div>
        <div class="col-12">
            <form method="get" class="form-inline" ">
            <div class="form-group mr-2">
                <label for="facility-input"> Facility:</label>
                <input type="text" id="facility" name="facility" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info ">
                <span style="font-weight:bold; color: black">Get info</span>
            </button>
            </form>
        </div>



        <!-- Display the schedule table -->
        <?php if (isset($facility7)) { ?>
            <!--table for schedule-->
            <div class="col-12 col-sm" id="EmailTable">
                <div class="table-responsive">
                    <!--table can scroll horizontally when using small screen devices-->
                    <table class="table table-striped">
                        <!--striped: design a table with alternate rows in different colors-->
                        <thead class="thead-dark">
                        <!--render the head dark-->
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>start date</th>
                            <th>Date of birth</th>
                            <th>MCN</th>
                            <th>telephone number</th>
                            <th>address</th>
                            <th>city</th>
                            <th>province</th>
                            <th>Postal code</th>
                            <th>citizenship</th>
                            <th>Email address</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($facility7 as $row) { ?>
                            <tr>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['start_time']; ?></td>
                                <td><?php echo $row['date_of_birth']; ?></td>
                                <td><?php echo $row['MCN']; ?></td>
                                <td><?php echo $row['telephone_number']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['province']; ?></td>
                                <td><?php echo $row['postal_code']; ?></td>
                                <td><?php echo $row['citizenship']; ?></td>
                                <td><?php echo $row['email_address']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-------------------------------Get details of all the doctors who have been infected by COVID-19 in the past two weeks.------------------------------------------------->
    <div class="row row-content  align-items-center">
        <div class="col-12">
            <h2>Question 9: Get details of all the doctors who have been infected by COVID-19 in the past
                two weeks.</h2>
            <!--Accordion-->
            <div id="accordion">
                <!------------------------------------------------------------Facilities---------------------------------->
                <div class="card">
                    <div class="card-header " role="tab" id="Q9TableTableHead">
                        <div class="d-flex">
                            <h3 class="mb-0">
                                <a data-toggle="collapse" data-target="#Q9Table">
                                    Employees Table
                                </a>
                        </div>
                    </div>
                    <!--table for Facilities-->
                    <div role="tabpanel" class="show" id="Q9Table" data-parent="#accordion">
                        <div class="card-body">
                            <div class="col-12 col-sm">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Date</th>
                                        <th>Facility</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($Facility9 as $row) { ?>
                                            <tr>
                                                <td><?= $row["first_name"] ?></td>
                                                <td><?= $row["last_name"] ?></td>
                                                <td><?= $row["date"] ?></td>
                                                <td><?= $row["Fname"] ?></td>

                                            </tr>
                                        <?php  } ?>
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
    <!-------------------------------.Q13 For every facility, provide the province where the facility is located---------->
    <div class="row row-content  align-items-center">
        <div class="col-12">
            <h2>Question 13:. For every facility, provide the province where the facility is located, the
                facility name, the capacity of the facility, and the total number of employees
                in the facility who have been infected by COVID-19 in the past two weeks. </h2>
    <!--Accordion-->
    <div id="accordion">

        <div class="card">
            <div class="card-header " role="tab" id="Q13TableHead">
                <div class="d-flex">
                    <h3 class="mb-0">
                        <a data-toggle="collapse" data-target="#Q13Table">
                            Facilities Table
                        </a>
                </div>
            </div>
            <!--table for Facilities-->
            <div role="tabpanel" class="show" id="Q13Table" data-parent="#accordion">
                <div class="card-body">
                    <div class="col-12 col-sm">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                <th>province</th>
                                <th>Facility</th>
                                <th>Capacity</th>
                                <th>Infected number</th>

                                </thead>
                                <tbody>
                                <?php while ($row = $Facility13->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                    <tr>
                                        <td><?= $row["province"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["capacity"] ?></td>
                                        <td><?= $row["infected_count"] ?></td>


                                    </tr>
                                <?php  } ?>
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
    <!-------------------------------.Q14  For every doctor who is currently working in the province of “Québec”---------->
    <div class="row row-content  align-items-center">
        <div class="col-12">
            <h2>Question 14:.  For every doctor who is currently working in the province of “Québec”,
                provide the doctor’s first-name, last-name, the city of residence of the doctor,
                and the total number of facilities the doctor is currently working for. </h2>
            <!--Accordion-->
            <div id="accordion">

                <div class="card">
                    <div class="card-header " role="tab" id="Q13TableHead">
                        <div class="d-flex">
                            <h3 class="mb-0">
                                <a data-toggle="collapse" data-target="#Q15Table">
                                    Facilities Table
                                </a>
                        </div>
                    </div>
                    <!--table for Facilities-->
                    <div role="tabpanel" class="show" id="Q15Table" data-parent="#accordion">
                        <div class="card-body">
                            <div class="col-12 col-sm">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                        <th>First_name</th>
                                        <th>Last name</th>
                                        <th>City</th>
                                        <th>facility number</th>

                                        </thead>
                                        <tbody>
                                        <?php while ($row = $Facility14->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                            <tr>
                                                <td><?= $row["first_name"] ?></td>
                                                <td><?= $row["last_name"] ?></td>
                                                <td><?= $row["city"] ?></td>
                                                <td><?= $row["facility_count"] ?></td>
                                            </tr>
                                        <?php  } ?>
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
    <!-------------------------------.Q16  Get details of the nurse(s) or the doctor(s) who are currently working and has
been infected by COVID-19 at least three times.---------->
    <div class="row row-content  align-items-center">
        <div class="col-12">
            <h2>Question 16: Get details of the nurse(s) or the doctor(s) who are currently working and has
                been infected by COVID-19 at least three times. </h2>
            <!--Accordion-->
            <div id="accordion">

                <div class="card">
                    <div class="card-header " role="tab" id="Q16TableHead">
                        <div class="d-flex">
                            <h3 class="mb-0">
                                <a data-toggle="collapse" data-target="#Q16Table">
                                    Facilities Table
                                </a>
                        </div>
                    </div>
                    <!--table for Facilities-->
                    <div role="tabpanel" class="show" id="Q16Table" data-parent="#accordion">
                        <div class="card-body">
                            <div class="col-12 col-sm">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                        <th>First_name</th>
                                        <th>Last name</th>
                                        <th>First day of work </th>
                                        <th>Role</th>
                                        <th>Date of birth</th>
                                        <th>Email address</th>
                                        <th>total number of hours scheduled </th>


                                        </thead>
                                        <tbody>
                                        <?php while ($row = $Facility16->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                            <tr>
                                                <td><?= $row["first_name"] ?></td>
                                                <td><?= $row["last_name"] ?></td>
                                                <td><?= $row["first_day_work"] ?></td>
                                                <td><?= $row["role"] ?></td>
                                                <td><?= $row["date_of_birth"] ?></td>
                                                <td><?= $row["email_address"] ?></td>
                                                <td><?= $row["total_hours_scheduled"] ?></td>
                                            </tr>
                                        <?php  } ?>
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

    <!-------------------------------.Q17  Get details of the nurse(s) or the doctor(s) who are currently working and has
been infected by COVID-19 at least three times.---------->
    <div class="row row-content  align-items-center">
        <div class="col-12">
            <h2>Question 17:  Get details of the nurse(s) or the doctor(s) who are currently working and has
                never been infected by COVID-19 </h2>
            <!--Accordion-->
            <div id="accordion">

                <div class="card">
                    <div class="card-header " role="tab" id="Q17TableHead">
                        <div class="d-flex">
                            <h3 class="mb-0">
                                <a data-toggle="collapse" data-target="#Q17Table">
                                    Facilities Table
                                </a>
                        </div>
                    </div>
                    <!--table for Facilities-->
                    <div role="tabpanel" class="show" id="Q17Table" data-parent="#accordion">
                        <div class="card-body">
                            <div class="col-12 col-sm">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                        <th>First_name</th>
                                        <th>Last name</th>
                                        <th>First day of work </th>
                                        <th>Role</th>
                                        <th>Date of birth</th>
                                        <th>Email address</th>
                                        <th>total number of hours scheduled </th>


                                        </thead>
                                        <tbody>
                                        <?php while ($row = $Facility17->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                            <tr>
                                                <td><?= $row["first_name"] ?></td>
                                                <td><?= $row["last_name"] ?></td>
                                                <td><?= $row["first_day_work"] ?></td>
                                                <td><?= $row["role"] ?></td>
                                                <td><?= $row["date_of_birth"] ?></td>
                                                <td><?= $row["email_address"] ?></td>
                                                <td><?= $row["total_hours_scheduled"] ?></td>
                                            </tr>
                                        <?php  } ?>
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



<!-----------------------------------Content end---------------------------------------------------------------->

<footer class="footer ">
    <div class="container">
        <div class="row">
            <div class="col-4 offset-1 col-sm-2">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="Modify/index.php">Modify</a></li>
                    <li><a href="information/index.php">Infomation</a></li>
                    <li><a href="./index.php">Schedule</a></li>
                    <li><a href="email/index.php">Email</a></li>
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