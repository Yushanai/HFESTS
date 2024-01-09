<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="MIME">

    <!-- Bootstrap CSS -->
    <!-- build:css css/main.css-->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- endbuild -->
    <title>HFESTS</title>
</head>

<body>
    <!--------------------navigation bar---------------------->
    <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto " href="./index.php"><img src="img/logo.png" height="30" width="41"
                    class="img-fluid"></a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link fa-lg" href="./index.php"> <span
                                class="fa fa-hospital-o "></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="Modify/index.php"><span
                                class="fa fa-pencil  "></span>Modify</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="Information/index.php"><span
                                class="fa fa-info "></span>Infomation</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="Schedule/index.php"><span
                                class="fa fa-calendar-o "></span>Schedule</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="Email/index.php"><span
                                class="fa fa-envelope-o  "></span>Email</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!---------------------------jumbotron---------------------------------->
    <header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-12 col-sm-6 ">
                    <h1>Health Facility Employee Status Tracking System</h1>
                    <h5>The HFESTS system help health care facilities to
                        keep track of their employees’ health status during the COVID-19 pandemic.</h5>
                </div>
                <div class="col-12 col-sm align-items-center">
                    <img src="img/logo.png" class="image-fluid">

                </div>
            </div>
        </div>
    </header>
    <!-------------------------------jumbotron end---------------------------------->
    <!---------------------------------Content------------------------------------------------------------------>
    <div class="container">
        <div class="row row-content align-items-center">
            <!--row，align-items-center  是bootstrap的， row-content是自己css的-->
            <!--<div class="col-12 col-sm-4 order-sm-last col-md-3">
            <h3>The following functions can be realized in the Modify web page</h3>
            </div>  -->
            <div class="col col-sm order-sm-first col-md">
                <a href="Modify/index.php">
                    <h2 class="mt-0">Modify</h2>
                </a>
                <h4 class="d-none d-sm-block">The following functions can be realized in the Modify page</h4>
                <ul>
                    <li>Create/Delete/Edit/Display a Facility</li>
                    <li>Create/Delete/Edit/Display a Employee</li>
                    <li>Create/Delete/Edit/Display a Vaccination</li>
                    <li>Create/Delete/Edit/Display an Infection</li>
                </ul>
            </div>
        </div>

        <div class="row row-content align-items-center">
            <!--row，align-items-center  是bootstrap的， row-content是自己css的-->
            <!-- <div class="col-12 col-sm-4 order-sm-last col-md-3">
            <h3>The following functions can be realized in the Information page</h3>
            </div> -->
            <div class="col col-sm order-sm-first col-md">
                <a href="Information/index.php">
                    <h2 class="mt-0">Information</h2>
                </a>
                <h4 class="d-none d-sm-block">The following functions can be realized in the Information page</h4>
                <ul>
                    <li>All Facility info</li>
                    <li>All employee info</li>
                    <li>Infected doctors info</li>
                    <li>Quebec doctor info</li>
                    <li>nurse with the longest working hours</li>
                    <li>Doctors or nurses who have been infected with COVID-19 three times or more.</li>
                    <li>Doctors or nurses who has not been infected</li>
                    <li>All Facility info</li>
                    <li>The number of infected people in each facility.</li>
                </ul>
            </div>
        </div>

        <div class="row row-content align-items-center">
            <!--row，align-items-center  是bootstrap的， row-content是自己css的-->
            <!-- <div class="col-12 col-sm-4 order-sm-last col-md-3">
            <h3>The following functions can be realized in the Information page</h3>
            </div> -->
            <div class="col col-sm order-sm-first col-md">
                <a href="Schedule/index.php">
                    <h2 class="mt-0">Schedule</h2>
                </a>
                <h4 class="d-none d-sm-block">The following functions can be realized in the Schedule page</h4>
                <ul>
                    <li>Schedule a time</li>
                    <li>Schedule history</li>
                    <li>schedule info(Search by name)</li>
                    <li>Quebec doctor info</li>
                    <li>nurse with the longest working hours</li>
                    <li>list of all the doctors who have been on schedule to work in the last two weeks.(Search by
                        facility)</li>
                    <li>Total hours scheduled for every role in specific period(Search by facility)</li>
                </ul>
            </div>
        </div>

        <div class="row row-content align-items-center">
            <!--row，align-items-center  是bootstrap的， row-content是自己css的-->
            <!-- <div class="col-12 col-sm-4 order-sm-last col-md-3">
            <h3>The following functions can be realized in the Information page</h3>
            </div> -->
            <div class="col col-sm order-sm-first col-md">
                <a href="Email/index.php">
                    <h2 class="mt-0">Email</h2>
                </a>
                <h4 class="d-none d-sm-block">The following functions can be realized in the Email page</h4>
                <ul>
                    <li>Automaticly generate email:</li>
                    <li> warning email</li>
                    <li> Sunday email</li>
                    <li>List the history of the email(Search by facility)</li>
                    <li>logs of emails(historyof the email)</li>
                </ul>
            </div>
        </div>

    </div>



    <!--------------------------------------------------------------------------------------------------->

    <footer class="footer ">
        <div class="container">
            <div class="row">
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="Modify/index.php">Modify</a></li>
                        <li><a href="Information/index.php">Infomation</a></li>
                        <li><a href="Schedule/index.php">Schedule</a></li>
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
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/da57742d83.js" crossorigin="anonymous"></script>
</body>

</html>