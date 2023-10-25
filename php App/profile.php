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
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="js/semantic.min.js" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<?php
session_start();
$error_message = "";

include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

    <body class="inner_page contact_page">
        <div class="full_container">
            <div class="inner_container">
                <?php include "header.php"; ?>
                <div id="content">
                    <?php include "header-top.php"; ?>
                    <div class="midde_cont">
                        <div class="container-fluid">
                            <div class="row column_title">
                                <div class="col-md-12">
                                    <div class="page_title">
                                        <h2>Profile</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row column1">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="full graph_head">
                                            <div class="heading1 margin_0">
                                                <h2>User profile</h2>
                                            </div>
                                        </div>
                                        <div class="full price_table padding_infor_info">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="full dis_flex center_text">
                                                        <div class="profile_img"><?php echo $profile_picture; ?></div>
                                                        <div class="profile_contant">
                                                            <div class="contact_inner">
                                                                <h3><?php echo $user['name']; ?></h3>
                                                                <p><strong>User Name: </strong><?php echo $user['user_name']; ?></p>
                                                                <ul class="list-unstyled">
                                                                    <li><i class="fa fa-envelope-o"></i> : <?php echo $user['email']; ?>
                                                                    </li>
                                                                    <li><i class="fa fa-phone"></i> : <?php echo $user['phone']; ?></li>
                                                                    <li><i class="fa fa-map-marker"></i> : <?php echo $user['address']; ?></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- profile contant section -->
                                                    <div class="full inner_elements margin_top_30">
                                                        <div class="tab_style2">
                                                            <div class="tabbar">
                                                                <nav>
                                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true">Edit Profile</a>
                                                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_worked" role="tab" aria-selected="false">Change Password</a>
                                                                    </div>
                                                                </nav>
                                                                <div class="tab-content" id="nav-tabContent">
                                                                    <?php if (isset($_GET['success'])) { ?>
                                                                        <div class="alert alert-success " role="alert">
                                                                            <?php echo $_GET['success']; ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php if (isset($_GET['error'])) { ?>
                                                                        <p class="alert alert-danger"><?php echo $_GET['error']; ?></p>
                                                                    <?php } ?>
                                                                    <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                        <div class="msg_list_main">
                                                                            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                                                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                                                <div class="row">
                                                                                    <div class="form-floating col">
                                                                                        <input type="text" class="form-control" id="Name" value="<?php echo $user['name']; ?>" name="name" placeholder="Name">
                                                                                        <label for="Name">Name</label>
                                                                                    </div>
                                                                                    <div class="form-floating col">
                                                                                        <input type="text" name="uname" class="form-control" value="<?php echo $user['user_name']; ?>" placeholder="User Name">
                                                                                        <label for="uname">User Name</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mt-3">
                                                                                    <div class="form-floating col">
                                                                                        <input type="text" class="form-control" id="phone" value="<?php echo $user['phone']; ?>" name="phone" placeholder="Phone">
                                                                                        <label for="phone">Number Phone</label>
                                                                                    </div>
                                                                                    <div class="form-floating col">
                                                                                        <input type="text" name="email" class="form-control" placeholder="E-mail" value="<?php echo $user['email']; ?>">
                                                                                        <label for="email">E-mail</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mt-3">
                                                                                    <div class="form-floating col">
                                                                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" placeholder="Address">
                                                                                        <label for="address">Address</label>
                                                                                    </div>
                                                                                    <div class="form-floating col">
                                                                                        <input type="file" class="form-control" id="image" name="image" placeholder="Profile Image">
                                                                                        <label for="image">Profile Image</label>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="submit" class="main_bt mt-4 mx-5 me-5" name="submit" value="Update">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="project_worked" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                                        <form method="post" action="change_password.php">
                                                                            <div class="form-group row">
                                                                                <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="password" class="form-control" required id="inputName">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="password" name="password" class="form-control" required id="inputEmail">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="password" class="form-control" required id="inputName2">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="offset-sm-2 col-sm-10">
                                                                                    <button type="submit" name="change_client_password" class="main_bt mt-4 mx-5 me-5">Change Password</button>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end user profile section -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <!-- end row -->
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