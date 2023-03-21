<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<, initial-scale=1.0">

    !-- Bootstrap CSS -->
        <!-- build:css css/main.css-->
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
        <link rel="stylesheet" href="css/styles.css">
        <!-- endbuild -->
    <title>Document</title>
</head>

<body>
     <!--------------------navigation bar---------------------->
     <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="./index.php"><img src="img/logo.png" height="30" width="41"></a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="./index.php"><span class="fa fa-hospital-o">Home</a></span></li>
                    <li class="nav-item"><a class="nav-link" href="./modify.html"><span class="fa fa-pencil  fa-lg">Modify</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./information.php"><span class="fa fa-info fa-lg">Infomation</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./schedule.php"><span class="fa fa-calendar-o fa-lg">Schedule</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./email.html"><span class="fa fa-envelope-o  fa-lg">Email</span></a></li>
                    
    
                </ul>
                <!--Modal links-->
                <span class="navbar-text">
                    <a data-toggle="modal" data-target="#loginModal">
                        <span class="fa fa-sign-in"></span>Login
                    </a>
                </span>
            </div>
            
        </div>
    </nav>
    <h1>Welcome!</h1>
    <p>choose one of Table!</p>
    <a href="./Employees/">Employees</a>
</body>

</html>