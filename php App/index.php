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
<?
if (isset($_POST['remember_me'])) {
    $token = bin2hex(random_bytes(32));

    setcookie("remember_me_cookie", $token, time() + 30 * 24 * 60 * 60, "/");
}
?>

<body class="inner_page login">
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
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_GET['success']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <form action="login.php" method="post">
                            <fieldset>
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="alert alert-danger"><?php echo $_GET['error']; ?></p>
                                <?php } ?>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="uname" name="uname" placeholder="User Name">
                                    <label for="uname">User Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" id="Password">
                                    <label for="Password">Password</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                                    <label class="form-check-label" for="remember_me">
                                        Remember Me
                                    </label>
                                    <a class="forgot mx-2" href="">Forgotten Password?</a>
                                </div>
                                <div class="field mt-5">
                                    <button class="main_bt mx-5 me-5">Sing In</button>
                                    <a href="signup.php">Create an account</a>
                                </div>
                            </fieldset>
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