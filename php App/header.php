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
<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><?php echo $profile_picture; ?></div>
                <div class="user_info">
                    <h6><?php echo $_SESSION['name']; ?></h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">
            <li><a href="dashboard.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>
            <li><a href="profile.php"><i class="fa fa-user orange_color"></i><span>User Profile</span></a></li>
            <li><a href="category-index.php"><i class="fa fa-diamond purple_color"></i><span>Category</span></a></li>
            <li>
                <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-desktop red_color"></i><span>Products</span></a>
                <ul class="collapse list-unstyled" id="element">
                    <li><a href="product-index.php">> <span>Products </span></a></li>
                    <li><a href="product-create.php">> <span>Product Create</span></a></li>
                </ul>
            </li>
            <li><a href="users-index.php"><i class="fa fa-users green_color"></i><span>Users</span></a></li>
            <li><a href="tables.html"><i class="fa fa-table purple_color2"></i> <span>Tables</span></a></li>
            <li>
                <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Apps</span></a>
                <ul class="collapse list-unstyled" id="apps">
                    <li><a href="email.html">> <span>Email</span></a></li>
                    <li><a href="calendar.html">> <span>Calendar</span></a></li>
                    <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
                </ul>
            </li>
            <li><a href="price.html"><i class="fa fa-briefcase blue1_color"></i> <span>Pricing Tables</span></a></li>
            <li>
                <a href="contact.html">
                    <i class="fa fa-paper-plane red_color"></i> <span>Contact</span></a>
            </li>
            <li class="active">
                <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Additional Pages</span></a>
                <ul class="collapse list-unstyled" id="additional_page">
                    <li>
                        <a href="profile.html">> <span>Profile</span></a>
                    </li>
                    <li>
                        <a href="project.html">> <span>Projects</span></a>
                    </li>
                    <li>
                        <a href="login.html">> <span>Login</span></a>
                    </li>
                    <li>
                        <a href="404_error.html">> <span>404 Error</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="map.html"><i class="fa fa-map purple_color2"></i> <span>Map</span></a></li>
            <li><a href="charts.html"><i class="fa fa-bar-chart-o green_color"></i> <span>Charts</span></a></li>
            <li><a href="settings.html"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
        </ul>
    </div>
</nav>