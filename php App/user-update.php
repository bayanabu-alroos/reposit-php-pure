<?php
session_start();
include "db_conn.php"; // Include your database connection

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $UserData = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($UserData)) {
        } else {
            echo "User not found";
        }
    } else {
        echo "User ID not provided";
    }
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_name = validate($_POST['user_name']);
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $re_password = validate($_POST['re_password']);
        $phone = validate($_POST['phone']);
        $address = validate($_POST['address']);
        $type_user = validate($_POST['type_user']);
        $image = $_FILES['image'];
        $id = $_POST['id'];


        // Validation (you can add more validation as needed)
        $errors = [];
        if (empty($user_name)) {
            $errors['user_name'] = 'User Name is required';
        }
        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }
        if (empty($email)) {
            $errors['email'] = 'E-mail is required';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        }
        if (empty($re_password)) {
            $errors['re_password'] = 'Confirm Password is required';
        } elseif ($password !== $re_password) {
            $errors['re_password'] = 'Passwords do not match';
        }
        if (empty($phone)) {
            $errors['phone'] = 'Number phone is required';
        }
        if (empty($address)) {
            $errors['address'] = 'Address is required';
        }
        if (empty($type_user)) {
            $errors['type_user'] = 'Type user is required';
        }

        // Check if email or username is already in use
        $query = "SELECT user_name, email FROM users WHERE (user_name = ? OR email = ?) AND id <> ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $user_name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            if ($existingUser['user_name'] == $user_name) {
                $errors['user_name'] = 'User Name is already in use';
            }
            if ($existingUser['email'] == $email) {
                $errors['email'] = 'E-mail is already in use';
            }
        }

        if (empty($errors)) {
            // Handle image upload
            $targetDir = "upload/imageProfile/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (!empty($_FILES['image']['name'])) {
                if (!in_array($fileType, $allowTypes)) {
                    $errors['image'] = "Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.";
                } elseif (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    // Continue with database insert
                } else {
                    $errors['image'] = "Error uploading image.";
                }
            }

            if (empty($errors)) {
                // Prepare the SQL query for inserting user data into the database
                $query = "UPDATE users
                SET user_name = ?, name = ?, email = ?, password = ?, 
                phone = ?, image = ?, address = ?, type_user = ?
                WHERE id = ?";
                $stmt = $conn->prepare($query);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt->bindParam(1, $user_name);
                $stmt->bindParam(2, $name);
                $stmt->bindParam(3, $email);
                $stmt->bindParam(4, $hashedPassword);
                $stmt->bindParam(5, $phone);
                $stmt->bindParam(6, $fileName); // Store the path to the uploaded image
                $stmt->bindParam(7, $address);
                $stmt->bindParam(8, $type_user);
                $stmt->bindParam(9, $id);

                // Execute the query to insert data into the database
                if ($stmt->execute()) {
                    // Data inserted successfully
                    header("Location: users-index.php?success=Update  User is successfully");
                    exit();
                } else {
                    header("Location: user-create.php?error=Update User failed: " . $stmt->errorInfo());
                    exit();
                }
            }
        }
    }



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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>

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
                                        <h2>Update New User </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="table_section padding_infor_info">
                                            <div class="table-responsive-sm">
                                                <div class="msg_list_main">
                                                    <?php if (isset($_GET['error'])) { ?>
                                                        <div class="alert alert-danger " role="alert">
                                                            <?php echo $_GET['error']; ?>
                                                        </div>
                                                    <?php } ?>
                                                    <form method="post" action="user-update.php" enctype="multipart/form-data">
                                                        <input name="id" type="" id="update_id" value="<?php echo $UserData['id']; ?>">
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $UserData['user_name']; ?>">
                                                                    <label for="user_name">User Name</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['user_name'] ?? ''; ?></span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <select class="form-select" name="type_user" id="type_user">
                                                                        <option value="<?php echo $UserData['type_user']; ?>"><?php echo $UserData['type_user']; ?></option>
                                                                        <option value="">Select User Type </option>
                                                                        <option value="user">Customer</option>
                                                                        <option value="admin">Admin</option>
                                                                    </select>
                                                                    <label for="floatingSelectGrid">Select User Type </label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['type_user'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" value="<?php echo $UserData['name']; ?>" id="name" name="name" id="name">
                                                                    <label for="name">Name</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['name'] ?? ''; ?></span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" value="<?php echo $UserData['email']; ?>" name="email" id="email">
                                                                    <label for="email">Email</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['email'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="file" class="form-control" id="image" value="<?php echo $UserData['image']; ?>" name="image" placeholder="Profile Image">
                                                                    <label for="image">User Image</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $UserData['address']; ?>" placeholder="Address">
                                                                    <label for="address">Address</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['address'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                                                    <label for="Password">Password</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['password'] ?? ''; ?></span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="password" name="re_password" class="form-control" placeholder="Confirm Password" id="ConfirmPassword">
                                                                    <label for="ConfirmPassword">Confirm Password</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['re_password'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="phone" value="<?php echo $UserData['phone']; ?>" name="phone" placeholder="Phone">
                                                                    <label for="phone">Number Phone</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['phone'] ?? ''; ?></span>
                                                                <div class="col-md">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="submit" class="main_bt mx-5 mt-5 me-5" value="Update User">
                                                    </form>
                                                </div>
                                            </div>
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