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
        <script src="https://kit.fontawesome.com/da57742d83.js" crossorigin="anonymous"></script>
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
            <a class="navbar-brand mr-auto " href="./index.php"><img src="../img/logo.png" height="30" width="41" class="img-fluid"></a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link fa-lg" href="../index.php"> <span class="fa fa-hospital-o "></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="index.php"><span class="fa fa-pencil  "></span>Modify</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="./information.php"><span class="fa fa-info "></span>Infomation</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="./schedule.php"><span class="fa fa-calendar-o "></span>Schedule</a></li>
                    <li class="nav-item"><a class="nav-link fa-lg" href="./email.php"><span class="fa fa-envelope-o  "></span>Email</a></li>    
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


     <!--------------------------------------------------------------------------------------------------->
       
<footer class="footer mt-auto py-3">
    <div class="container">
        <div class="row">             
            <div class="col-4 offset-1 col-sm-2">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./modify.php">Modify</a></li>
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
                    <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus"></i></a>
                    <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook"></i></a>
                    <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin"></i></a>
                    <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                    <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i class="fa fa-youtube"></i></a>
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
</body>

</html>