<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brand Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Croissant+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="blue">
                <img src="img/header-shepe-blue.png" alt="">
            </div>
            <div class="white">
                <img src="img/header-shepe-white.png" alt="">
            </div>
            <div class="container">
                <img class="shepe1" src="img/shepe1.png" alt="">
                <img class="shepe2" src="img/shepe2.png" alt="">
                <img class="shepe3" src="img/shepe2.png" alt="">
                <img class="shepe4" src="img/shepe2.png" alt="">
                <img class="shepe5" src="img/shepe1.png" alt="">
                <img class="shepe6" src="img/shepe2.png" alt="">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="logo">
                            <h2><a href="StaffDashboard.php">TSM</a></h2>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="menu">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Admin Dashboard</a></li>
                                <li><a href="StaffDashboard.php">Home</a></li>
                                <li><a href="Staff_Logout.php">Log Out</a></li>
                                <li><a href="StaffEntryDash.php">Register</a></li>
                                <li><a href="ToolsDash.php">Tools</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-text">
                            <?php 
                                include ('BrandRegister.php');
                                include ('BrandView.php');
                             ?>
                        </div>
                    </div>
                </div>
        </section>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="footer-icon">
                            <h2>TSM</h2>
                            <p><a href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a><a href="#"><i aria-hidden="true" class="fa fa-linkedin"></i></a><a href="#"><i aria-hidden="true" class="fa fa-dribbble"></i></a><a href="#"><i aria-hidden="true" class="fa fa-behance"></i></a><a href="#"><i aria-hidden="true" class="fa fa-google-plus"></i></a></p>
                            <h5>&copy; All Right Reserved.</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="footer-text">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="footer-text-single">
                                        <h3>What is this?</h3>
                                        <p><a>Admin Dashboard</a></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="footer-text-single">
                                        <h3>Staff Rules</h3>
                                        <p><a>No overflooding the database</a></p>
                                        <p><a>Tutorials</a></p>
                                        <p><a>Learn Policy</a></p>
                                        <p><a>Work Hard</a></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="footer-text-single">
                                        <h3>Tools</h3>
                                        <p><a href="StaffEntry.php">Create Account</a></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="footer-text-single">
                                        <h3>Get In Touch</h3>
                                        <p><a>Contact Us via lazykarma2002@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/active.js"></script>
</body>

</html>