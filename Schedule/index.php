<?php require_once './../database.php';
$schedule = $conn->prepare('SELECT*FROM schedule');
$schedule->execute();

if (isset($_GET['MCN'])) {
    // Retrieve schedule for the specified MCN
    $statement = $conn->prepare("SELECT * FROM schedule WHERE MCN = :MCN ");
    $statement->bindParam(":MCN", $_GET["MCN"]);
    $statement->execute();
    $employee = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Show the form
    $formHidden = false;
} else {
    // Hide the form
    $formHidden = true;
}
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
                <li class="nav-item"><a class="nav-link fa-lg" href="./information.php"><span
                                class="fa fa-info "></span>Infomation</a></li>
                <li class="nav-item"><a class="nav-link fa-lg" href="./index.php"><span
                                class="fa fa-calendar-o "></span>Schedule</a></li>
                <li class="nav-item"><a class="nav-link fa-lg" href="./email.php"><span
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
       <form method="get" class="form-inline">
           <div class="form-group mr-2">
               <label for="mcn-input"></label>
               <input type="number" id="MCN" name="MCN" class="form-control" required>
           </div>
           <button type="submit" class="btn btn-info btn-sm">
               <span style="font-weight:bold; color: black">Get info</span>
           </button>
       </form>
       </div>


       <!-- Display the schedule table -->
       <?php if (isset($employee)) { ?>
       <!--table for schedule-->
       <div class="col-12 col-sm">
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

       <!-- JavaScript to show the form -->
       <script>
           document.querySelector('#MCN').addEventListener('input', function() {
               document.querySelector('form').removeAttribute('hidden');
           });
       </script>

    </div>
    <!----------------------------------------------------------------->

    <div class="row row-content">
        <div class="col-12 col-sm-9">
            <!--Accordion-->
            <div id="accordion">
                <!------------------------------------------------------------Employees---------------------------------->
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
                            <div class="col-12 col-sm">
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
    <!--------------------------------------------------------------------------------------------------->
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