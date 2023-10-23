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
include "db_conn.php";

if (isset($_POST['submit'])) {
    try {
        $name = $_POST['name'];
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $image =$_POST['image'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];

        $sql = "UPDATE users SET user_name = ?,name = ?, email = ?,address = ?, phone = ? ,image = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name,$user_name, $email, $address, $phone,$image, $id]);

        $sub = "Updated done";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif (isset($_POST['cancel'])) {
    header('location: profile.php');
}

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $user_id = $_SESSION['id'];

    // Your PDO connection object should be in the $conn variable

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        // Handle the database error as needed
    }
?>




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
                                                <!-- user profile section -->
                                                <!-- profile image -->
                                                <div class="col-lg-12">
                                                    <div class="full dis_flex center_text">
                                                        <div class="profile_img"><img width="180" class="rounded-circle" src="images/layout_img/avatar.jpg" alt="#" /></div>
                                                        <div class="profile_contant">
                                                            <div class="contact_inner">
                                                                <h3><?php echo $user['name']; ?></h3>
                                                                <p><strong>User Name: </strong><?php echo $user['user_name']; ?></p>
                                                                <ul class="list-unstyled">
                                                                    <li><i class="fa fa-envelope-o"></i> :
                                                                        <?php echo $user['email']; ?>
                                                                    </li>
                                                                    <li><i class="fa fa-phone"></i> : 987 654 3210</li>
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
                                                                    </div>
                                                                </nav>
                                                                <div class="tab-content" id="nav-tabContent">
                                                                    <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                        <div class="msg_list_main">
                                                                            <div class="row">
                                                                                <div class="form-floating col">
                                                                                    <input type="text" class="form-control" id="Name" value="<?php echo $user['name']; ?>" name="name" placeholder="Name">
                                                                                    <label for="Name">Name</label>
                                                                                </div>
                                                                                <div class="form-floating col">
                                                                                    <?php if (isset($_GET['uname'])) { ?>
                                                                                        <input type="text" name="uname" class="form-control" placeholder="User Name"  value="<?php echo $_GET['uname']; ?>"><br>
                                                                                    <?php } else { ?>
                                                                                        <input type="text" name="uname" class="form-control" value="<?php echo $user['user_name']; ?>"  placeholder="User Name">
                                                                                    <?php } ?>
                                                                                    <label for="uname">User Name</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="form-floating col">
                                                                                    <input type="text" class="form-control" id="phone" value="<?php echo $user['phone']; ?>" name="phone" placeholder="Phone">
                                                                                    <label for="phone">Number Phone</label>
                                                                                </div>
                                                                                <div class="form-floating col">
                                                                                    <?php if (isset($_GET['email'])) { ?>
                                                                                        <input type="text" name="email" class="form-control" placeholder="E-mail"  value="<?php echo $_GET['email']; ?>"><br>
                                                                                    <?php } else { ?>
                                                                                        <input type="text" name="email" class="form-control" value="<?php echo $user['email']; ?>"  placeholder="E-mail">
                                                                                    <?php } ?>
                                                                                    <label for="email">E-mail</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
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