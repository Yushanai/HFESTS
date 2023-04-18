<?php require_once './../database.php';
//Schedule History
$schedule = $conn->prepare('SELECT*FROM schedule');
$schedule->execute();
//------------------------------------------

//Information searched by MCN
if (isset($_GET['mcn'])) {
    // Retrieve schedule for the specified MCN
    $statement = $conn->prepare("SELECT * FROM schedule WHERE MCN = :MCN ");
    $statement->bindParam(":MCN", $_GET["mcn"]);
    $statement->execute();
    $employee = $statement->fetchAll(PDO::FETCH_ASSOC);


}
//-------------------------------------------

//Information searched by a specific period of time.
if(isset($_GET["MCN"]) && isset($_GET["startDate"]) && isset($_GET["endDate"])) {
    $statement = $conn->prepare("SELECT name, date, startTime, endTime 
        FROM schedule 
        WHERE MCN = :MCN AND date BETWEEN :startDate AND :endDate 
        ORDER BY name ASC, date ASC, startTime ASC");
    $statement->bindParam(":MCN", $_GET["MCN"]);    $statement->bindParam(":startDate", $_GET["startDate"]);
    $statement->bindParam(":endDate", $_GET["endDate"]);
    $statement->execute();
    $scheduleDetails = $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Q11
if (isset($_GET["facility"]) && isset($_GET["action"]) && $_GET['action'] == 'getInfo') {
    $facility = $_GET['facility'];
    // Query to retrieve the doctors and nurses who have been on schedule to work at the given facility in the last two weeks
    $statement = $conn->prepare("SELECT DISTINCT employees.first_name, employees.last_name, workat.role
        FROM employees
        JOIN workat ON employees.MCN = workat.MCN
        JOIN schedule ON workat.MCN = schedule.MCN 
        WHERE workat.Fname = :facility AND schedule.date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND workat.role IN ('Doctor', 'Nurse')
        GROUP BY employees.first_name, employees.last_name, workat.role
        ORDER BY workat.role ASC, employees.first_name ASC");

    $statement->bindParam(":facility", $facility);
    $statement->execute();
    $getInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Total hours 12
if (isset($_GET["facility"]) &&isset($_GET["action"])&& $_GET['action'] == 'totalHours') {
    $facility = $_GET['facility'];
    $statement = $conn->prepare("SELECT workat.role,SUM(TIME_TO_SEC(TIMEDIFF(schedule.endTime, schedule.startTime))) / 3600 AS total_hours
        FROM schedule
        JOIN workat ON schedule.MCN = workat.MCN
        WHERE workat.Fname = :facility  AND schedule.name = :facility
        GROUP BY workat.role
        ORDER BY workat.role ASC");
    $statement->bindParam(":facility", $facility);
    $success = $statement->execute();

    if ($success) {
        $totalHours = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $errorInfo = $statement->errorInfo();
        $errorMessage = $errorInfo[2];
        echo "Error retrieving total hours: $errorMessage";
    }
}
//Q15
$Facility15=$conn->prepare("SELECT e.first_name, e.last_name, MIN(w.start_time) AS first_day_work, e.date_of_birth, e.email_address, SUM(TIMESTAMPDIFF(HOUR, s.startTime, s.endTime)) AS total_hours_scheduled
FROM employees e
JOIN workat w ON e.MCN = w.MCN
JOIN schedule s ON e.MCN = s.MCN
WHERE w.role = 'Nurse' AND w.start_time = (
    SELECT MAX(w2.start_time)
    FROM workat w2
    WHERE w2.MCN = e.MCN AND w2.role = 'Nurse'
)
GROUP BY e.MCN
ORDER BY total_hours_scheduled DESC
LIMIT 1;


");
$Facility15->execute();
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
    <title>Schedule</title>
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
                <li class="nav-item"><a class="nav-link fa-lg" href="../Information/index.php"><span
                                class="fa fa-info "></span>Information</a></li>
                <li class="nav-item"><a class="nav-link fa-lg" href="./index.php"><span
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
                <h1>Schedule</h1>
                <h5>With Schedule, you can easily schedule a time, view your schedule history, search for schedule
                    info by name, find Quebec doctor info, identify the nurse with the longest working hours, and
                    search for a list of all the doctors who have been on schedule to work in the last two weeks by
                    facility. Additionally, you can easily calculate the total hours scheduled for every role in a
                    specific period, allowing you to manage your resources effectively. With Schedule, you'll never
                    miss an appointment again!</h5>
            </div>
            <div class="col-12 col-sm align-items-center">
                <img src="../img/logo.png" class="image-fluid">

            </div>
        </div>
    </div>
</header>
<!-------------------------------jumbotron end---------------------------------->
<!-------------------------------Content---------------------------------->
<!-------------------------------Assign/Delete/Edit schedule for an Employee---------------------------------->
<div class="container">
   <div class="row row-content align-items-center">
        <div class="col-12">
            <h2 class="mt-0">Insert employees MCN to get schedule table<span class="badge badge-info">Info</span></h2>
        </div>
       <div class="col-12">
       <form method="get" class="form-inline" onsubmit="showTable1();">
           <div class="form-group mr-2">
               <label for="mcn-input"> MCN:</label>
               <input type="number" id="mcn" name="mcn" class="form-control" required>
           </div>
           <button type="submit" class="btn btn-info ">
               <span style="font-weight:bold; color: black">Get info</span>
           </button>
       </form>
       </div>



       <!-- Display the schedule table -->
       <?php if (isset($employee)) { ?>
           <!--table for schedule-->
           <div class="col-12 col-sm" id="MCNTable">
               <div class="table-responsive">
                   <!--table can scroll horizontally when using small screen devices-->
                   <table class="table table-striped">
                       <!--striped: design a table with alternate rows in different colors-->
                       <thead class="thead-dark">
                       <!--render the head dark-->
                       <tr>
                           <th>Reference Number</th>
                           <th>MCN</th>
                           <th>Facility Name</th>
                           <th>Date</th>
                           <th>Start Time</th>
                           <th>End Time</th>

                       </tr>
                       </thead>
                       <tbody>
                       <?php foreach ($employee as $row) { ?>
                           <tr>
                               <td><?php echo $row['reference_number']; ?></td>
                               <td><?php echo $row['MCN']; ?></td>
                               <td><?php echo $row['name']; ?></td>
                               <td><?php echo $row['date']; ?></td>
                               <td><?php echo $row['startTime']; ?></td>
                               <td><?php echo $row['endTime']; ?></td>
                           </tr>
                       <?php } ?>
                       </tbody>
                   </table>
               </div>
           </div>
       <?php } ?>

    </div>
    <!--------------------------------Specific period of time--------------------------------->
    <div class="row row-content">
        <div class="col-12 col-sm-9">
            <div class="col-12">
                <h2 class="mt-0"> Get the details of all the schedules she/he has been
                    scheduled during a specific period of time.<span class="badge badge-info">Info</span></h2>
            </div>
            <div class="col-12">
                <form method="get" onsubmit="showTable();" >
                    <div class="form-group ">
                        <label for="mcn-input"> MCN:</label>
                        <input type="number" id="MCN" name="MCN" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <label for="startDate-input">Start Date:</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" required>
                    </div>
                    <div class="form-group ">
                        <label for="endDate-input">End Date: </label>
                        <input type="date" id="endDate" name="endDate" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-info ">
                        <span style="font-weight:bold; color: black">Get info</span>
                    </button>
                </form>
            </div>
        </div>

    <!-- Display the schedule table -->
    <?php if (isset($scheduleDetails)) { ?>
        <!--table for schedule-->
        <div class="col-12 col-sm" id="scheduleTable">
            <div class="table-responsive">
                <!--table can scroll horizontally when using small screen devices-->
                <table class="table table-striped">
                    <!--striped: design a table with alternate rows in different colors-->
                    <thead class="thead-dark">
                    <!--render the head dark-->
                    <tr>
                        <th>Facility Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($scheduleDetails as $row) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['startTime']; ?></td>
                            <td><?php echo $row['endTime']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
    <!-- Add JavaScript to show the table when the button is clicked -->
    <script>
        function showTable() {
            document.getElementById("scheduleTable").classList.remove("d-none");
        }
    </script>
    </div>
<!----------------------------------------------------------------->
    <div class="row row-content">
        <div class="col-12 col-sm-9">
            <!--Accordion-->
            <div id="accordion">
                <!------------------------------------------------------------Schedule Employees---------------------------------->
                <div class="card">
                    <div class="card-header" role="tab" id="Schedulehead">
                        <div class="d-flex">
                            <h3 class="mb-0">
                                <a data-toggle="collapse" data-target="#schedule">
                                    Schedule <small>Assign/Delete/Edit/ a schedule</small>
                                </a>
                            </h3>
                            <!--Create button-->
                            <button type="button" class="btn btn-success btn-sm " data-toggle="modal"
                                    data-target="#createSchedule">
                                <a style="font-weight:bold; color: black">Assign</a>
                            </button>
                        </div>
                    </div>
                    <!-- Button modal Content -->
                    <div id="createSchedule" class="modal fade" role="dialog" style="color:black ;">
                        <div class="modal-dialog modal-lg" role="content">
                            <div class="modal-content">
                                <div class="modal-header" style="background:#3e94f1 ;">
                                    <h4 class="modal-title">Assign Schedule</h4>
                                    <button type="button" class="close" data-dismiss="modal">
                                        &times;
                                    </button>
                                </div>
                                <div class="modal-body" style="background:floralwhite ;">
                                    <form class="form-group" id="Assign-Schedule" action="./assign.php"
                                          method="post">
                                        <label for="reference_number">Reference Number</label><br>
                                        <input type="number" name="reference_number" id="reference_number"><br>
                                        <label for="MCN">MCN number</label><br>
                                        <input type="number" name="MCN" id="MCN"> <br>
                                        <label for="name">Facility name</label><br>
                                        <input type="text" name="name" id="name"> <br>
                                        <label for="date">Date</label><br>
                                        <input type="date" name="date" id="date"> <br>
                                        <label for="startTime">Start Time</label><br>
                                        <input type="time" name="startTime" id="startTime"> <br>
                                        <label for="endTime">End Time</label><br>
                                        <input type="time" name="endTime" id="endTime"><br>
                                </div>
                                <div class="modal-footer" style="background:#3e94f1;">
                                    <div class="offset-md-2 col-md-10">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Assign</button>
                                    </div>
                                </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="show" id="schedule" data-parent="#accordion">
                        <!----------------------table for schedule--------------------------------------->
                        <div class="card-body">
                            <!--table for schedule-->
                            <div class="col-12 col-sm ">
                                <div class="table-responsive">
                                    <!--table can scroll horizontally when using small screen devices-->
                                    <table class="table table-striped">
                                        <!--striped: design a table with alternate rows in different colors-->
                                        <thead class="thead-dark">
                                        <!--render the head dark-->

                                        <th>Reference Nnumber</th>
                                        <th>MCN</th>
                                        <th>Facility name</th>
                                        <th>Date</th>
                                        <th>Start time</th>
                                        <th>End time</th>
                                        <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = $schedule->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                            <tr>
                                                <td><?= $row["reference_number"] ?></td>
                                                <td><?= $row["MCN"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["date"] ?></td>
                                                <td><?= $row["startTime"] ?></td>
                                                <td><?= $row["endTime"] ?></td>
                                                <td>
                                                    <!--edit button-->

                                                    <button type="submit" class="btn btn-primary btn-sm w-100"
                                                            data-toggle="modal" data-target="#editSchedule">
                                                        <a style="font-weight:bold; color: black">Edit
                                                        </a>
                                                    </button>



                                                    <!-- Button modal Content -->
                                                    <div id="editSchedule" class="modal fade" role="dialog"
                                                         style="color:black ;">
                                                        <div class="modal-dialog modal-lg" role="content">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background:#3e94f1 ;">
                                                                    <h4 class="modal-title">Edit Schedule</h4>
                                                                    <button type="submit" class="close"
                                                                            data-dismiss="modal">
                                                                        &times;
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body"
                                                                     style="background:floralwhite ;">
                                                                    <form class="form-group" id="edit-Schedule"
                                                                          action="./edit.php" method="post">
                                                                        <label for="reference_number">Reference Number</label><br>
                                                                        <input type="number" name="reference_number" id="reference_number"><br>
                                                                        <label for="MCN">MCN number</label><br>
                                                                        <input type="number" name="MCN" id="MCN"> <br>
                                                                        <label for="name">Facility name</label><br>
                                                                        <input type="text" name="name" id="name"> <br>
                                                                        <label for="date">Date</label><br>
                                                                        <input type="date" name="date" id="date"> <br>
                                                                        <label for="startTime">Start Time</label><br>
                                                                        <input type="time" name="startTime" id="startTime"> <br>
                                                                        <label for="endTime">End Time</label><br>
                                                                        <input type="time" name="endTime" id="endTime">
                                                                        <br><br><br>
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
                                                        <a href="./delete.php?reference_number=<?=$row["reference_number"]?>"
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
                </div>
            </div>
        </div>
    </div>

<!-------------------------------------------For a given facility name-------------------------------------------------------->'
    <div class="row row-content align-items-center">
        <div class="col-12">
            <h2 class="mt-0">Insert Facility  to get info<span class="badge badge-info">Info</span></h2>
        </div>
        <div class="col-12">
            <form method="get" class="form-inline">
                <div class="form-group mr-2">
                    <label for="facility-input"> Facility:</label>
                    <input type="text" id="facility" name="facility" class="form-control" required>
                </div>
                <div class="btn-group">
                <button type="submit" class="btn btn-info" name="action" value="getInfo">
                    <span style="font-weight:bold; color: black">Get info</span>
                </button>
                <button type="submit" class="btn btn-info"name="action" value="totalHours">
                    <span style="font-weight:bold; color: black">Total hours of every roles</span>
                </button>
                </div>
            </form>
        </div>



        <!-- Display the schedule table -->
        <?php if (isset($getInfo)) { ?>
        <!--table for schedule-->
        <div class="col-12 col-sm" id="MCNTable">
            <div class="table-responsive">
                <!--table can scroll horizontally when using small screen devices-->
                <table class="table table-striped">
                    <!--striped: design a table with alternate rows in different colors-->
                    <thead class="thead-dark">
                    <!--render the head dark-->
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($getInfo as $row ) { ?>
                        <tr>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
        <!-- Display the total hour table -->
        <?php if (isset($totalHours)) { ?>
            <!--table for schedule-->
            <div class="col-12 col-sm" id="MCNTable">
                <div class="table-responsive">
                    <!--table can scroll horizontally when using small screen devices-->
                    <table class="table table-striped">
                        <!--striped: design a table with alternate rows in different colors-->
                        <thead class="thead-dark">
                        <!--render the head dark-->
                        <tr>
                            <th>Role</th>
                            <th>Total Hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($totalHours) > 0) { ?>
                        <?php foreach ($totalHours as $row ) { ?>
                            <tr>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['total_hours']; ?></td>
                            </tr>
                        <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="2" style="text-align:center;">No results to display</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>

<!-------------------------------.Q15  Get details of the nurse(s) who is/are currently working and has the highest number of hours ---------->
<div class="row row-content  align-items-center">
    <div class="col-12">
        <h2>Question 15: Get details of the nurse(s) who is/are currently working and has the highest number of hours. </h2>
        <!--Accordion-->
        <div id="accordion">

            <div class="card">
                <div class="card-header " role="tab" id="Q15TableHead">
                    <div class="d-flex">
                        <h3 class="mb-0">
                            <a data-toggle="collapse" data-target="#Q15Table">
                                Details of the nurse(s) table
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
                                    <th>First day of work </th>
                                    <th>Date of birth</th>
                                    <th>Email address</th>
                                    <th>total number of hours scheduled </th>


                                    </thead>
                                    <tbody>
                                    <?php while ($row = $Facility15->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                                        <tr>
                                            <td><?= $row["first_name"] ?></td>
                                            <td><?= $row["last_name"] ?></td>
                                            <td><?= $row["first_day_work"] ?></td>
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
                    <li><a href="Email/index.php">Email</a></li>
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