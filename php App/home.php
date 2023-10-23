<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="images/logo/logo_icon.png" type="image/png" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="css/responsive.css" />
        <link rel="stylesheet" href="css/colors.css" />
        <link rel="stylesheet" href="css/bootstrap-select.css" />
        <link rel="stylesheet" href="css/perfect-scrollbar.css" />
        <link rel="stylesheet" href="css/custom.css" />
        <link rel="stylesheet" href="js/semantic.min.css" />
    </head>

    <body class="inner_page contact_page">
        <div class="full_container">
            <div class="inner_container">
                <?php include "header.php"; ?>
                <div id="content">
                    <div class="topbar">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="full">
                                <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                                <div class="logo_section">
                                    <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a>
                                </div>
                                <div class="right_topbar">
                                    <div class="icon_info">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                            <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                            <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                                        </ul>
                                        <ul class="user_profile_dd">
                                            <li>
                                                <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="images/layout_img/avatar.jpg" alt="#" /><span class="name_user"><?php echo $_SESSION['name']; ?></span></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="profile.html">My Profile</a>
                                                    <a class="dropdown-item" href="settings.html">Settings</a>
                                                    <a class="dropdown-item" href="help.html">Help</a>
                                                    <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="midde_cont">
                        <div class="container-fluid">
                            <div class="row column_title">
                                <div class="col-md-12">
                                    <div class="page_title">
                                        <h2>Dashboard</h2>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $_GET['success']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                            <div class="row column1">
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user yellow_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">2500</p>
                                                <p class="head_couter">Welcome</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-clock-o blue1_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">123.50</p>
                                                <p class="head_couter">Average Time</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-cloud-download green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">1,805</p>
                                                <p class="head_couter">Collections</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-comments-o red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">54</p>
                                                <p class="head_couter">Comments</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row column1 social_media_section">
                                <div class="col-md-6 col-lg-3">
                                    <div class="full socile_icons fb margin_bottom_30">
                                        <div class="social_icon">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                        <div class="social_cont">
                                            <ul>
                                                <li>
                                                    <span><strong>35k</strong></span>
                                                    <span>Friends</span>
                                                </li>
                                                <li>
                                                    <span><strong>128</strong></span>
                                                    <span>Feeds</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full socile_icons tw margin_bottom_30">
                                        <div class="social_icon">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                        <div class="social_cont">
                                            <ul>
                                                <li>
                                                    <span><strong>584k</strong></span>
                                                    <span>Followers</span>
                                                </li>
                                                <li>
                                                    <span><strong>978</strong></span>
                                                    <span>Tweets</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full socile_icons linked margin_bottom_30">
                                        <div class="social_icon">
                                            <i class="fa fa-linkedin"></i>
                                        </div>
                                        <div class="social_cont">
                                            <ul>
                                                <li>
                                                    <span><strong>758+</strong></span>
                                                    <span>Contacts</span>
                                                </li>
                                                <li>
                                                    <span><strong>365</strong></span>
                                                    <span>Feeds</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full socile_icons google_p margin_bottom_30">
                                        <div class="social_icon">
                                            <i class="fa fa-google-plus"></i>
                                        </div>
                                        <div class="social_cont">
                                            <ul>
                                                <li>
                                                    <span><strong>450</strong></span>
                                                    <span>Followers</span>
                                                </li>
                                                <li>
                                                    <span><strong>57</strong></span>
                                                    <span>Circles</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="footer">
                                    <p>Copyright © 2018 Designed by html.design. All rights reserved.<br><br>
                                        Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animate.js"></script>
        <script src="js/bootstrap-select.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/Chart.bundle.min.js"></script>
        <script src="js/utils.js"></script>
        <script src="js/analyser.js"></script>
        <script src="js/perfect-scrollbar.min.js"></script>
        <script>
            var ps = new PerfectScrollbar('#sidebar');
        </script>
        <script src="js/custom.js"></script>
        <script src="js/semantic.min.js"></script>
        <script></script>
    </body>

    </html>
<?php
} else if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>