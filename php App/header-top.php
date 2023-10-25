<?php
include "db_conn.php";
$user_id = $_SESSION['id'];
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['image'] == '') {
            $profile_picture = "
                <img class='img-fluid'
                src='upload/imageProfile/user_icon.png'
                alt='User profile picture'>
            ";
        } else {
            $profile_picture = "
                <img class='img-fluid' width='180' class='img-responsive rounded-circle' style='border-radius: 100% 100%;'
                src='upload/imageProfile/{$user['image']}'
                alt='User profile picture'>
            ";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        // Handle the database error as needed
    }
?>
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
                            <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $profile_picture; ?><span class="name_user"><?php echo $_SESSION['name']; ?></span></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.php">My Profile</a>
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