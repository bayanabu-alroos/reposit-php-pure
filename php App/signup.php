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
    <link rel="stylesheet" href="css/color_2.css" />
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="js/semantic.min.js" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body class="inner_page login">
    <?php
    session_start();
    include "db_conn.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $uname = validate($_POST['uname']);
        $email = validate($_POST['email']);
        $pass = validate($_POST['password']);
        $re_pass = validate($_POST['re_password']);
        $name = validate($_POST['name']);
        $errors = array(); // Initialize an array to store validation errors
        if (empty($uname)) {
            $errors['uname'] = 'User Name is required';
        }
        if (empty($email)) {
            $errors['email'] = 'E-mail is required';
        }
        if (empty($pass)) {
            $errors['pass'] = 'Password is required';
        }
        if (empty($re_pass)) {
            $errors['re_pass'] = 'Confirm Password is required';
        } elseif ($pass !== $re_pass) {
            $errors['re_pass'] = 'Passwords do not match';
        }
        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }
        if (count($errors) === 0) {
            $pass = md5($pass);
            $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = :uname OR email = :email");
            $stmt->bindParam(':uname', $uname);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $errors['uname'] = 'The username is taken. Please try another';
                $errors['email'] = 'The email is taken. Please try another';
            } else {
                $stmt = $conn->prepare("INSERT INTO users (user_name, password, name,email) VALUES (:uname, :pass, :name,:email)");
                $stmt->bindParam(':uname', $uname);
                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                if ($stmt->execute()) {
                    header("Location: index.php?success=Your account has been created successfully");
                    exit();
                } else {
                    $errors['general'] = "An unknown error occurred&$user_data";
                }
            }
        }
    }
    ?>



    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="images/logo/logo.png" alt="#" />
                        </div>
                    </div>
                    <div class="login_form">
                        <form method="post" action="signup.php">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="Name" name="name" placeholder="Name">
                                <label for="Name">Name</label>
                            </div>
                            <span class="text-danger"><?php echo $errors['name'] ?? ''; ?></span>
                            <div class="form-floating">
                                <?php if (isset($_GET['uname'])) { ?>
                                    <input type="text" name="uname" class="form-control" placeholder="User Name" value="<?php echo $_GET['uname']; ?>"><br>
                                <?php } else { ?>
                                    <input type="text" name="uname" class="form-control" placeholder="User Name">
                                <?php } ?>
                                <label for="uname">User Name</label>
                            </div>
                            <span class="text-danger"><?php echo $errors['uname'] ?? ''; ?></span>
                            <div class="form-floating">
                                <?php if (isset($_GET['email'])) { ?>
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo $_GET['uname']; ?>"><br>
                                <?php } else { ?>
                                    <input type="text" name="email" class="form-control" placeholder="E-mail">
                                <?php } ?>
                                <label for="email">E-mail</label>
                            </div>
                            <span class="text-danger"><?php echo $errors['uname'] ?? ''; ?></span>
                            <div class="form-floating">
                                <input  type="password" name="password" class="form-control" placeholder="Password" id="Password" >
                                <label for="Password">Password</label>
                            </div>
                            <span class="text-danger"><?php echo $errors['pass'] ?? ''; ?></span>
                            <div class="form-floating">
                                <input  type="password" name="re_password" class="form-control" placeholder="Confirm Password" id="ConfirmPassword" >
                                <label for="ConfirmPassword">Confirm Password</label>
                            </div>
                            <div class="form-floating">
                                <span class="text-danger"><?php echo $errors['re_pass'] ?? ''; ?></span>
                            </div>
                            <input type="submit" class="main_bt mx-5 mt-5 me-5" value="Sign Up">
                            <span class="text-danger"><?php echo $errors['general'] ?? ''; ?></span>
                            <a class="d-block mt-5 mx-auto" href="index.php">Already have an account?</a>
                        </form>
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
    <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <script src="js/custom.js"></script>
</body>

</html>