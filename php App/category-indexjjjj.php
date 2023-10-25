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

    $query = "SELECT * FROM categories";
    $stmt = $conn->prepare($query);

    while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Access and use $category data here
    }
?>


    <body class="inner_page contact_page">
        <div class="full_container">
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Create New Category</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="insert-category.php" method="POST">
                            <div class="modal-body">
                                <div class="form-floating">
                                    <input type="text" class="form-control" required id="cat_title" name="cat_title" placeholder="Enter Category Title">
                                    <label for="cat_title">Category Title</label>
                                </div>
                                <?php if (isset($errors['cat_title'])) : ?>
                                    <div class="text-danger"><?php echo $errors['cat_title']; ?></div>
                                <?php endif; ?> <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" name="insertdata" id="insertButton" class="btn btn-primary">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end model popup -->
            <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Edit Category Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="update-category.php" method="POST">
                            <div class="modal-body">
                                <input type="" name="cat_id" value="<?php echo $category['cat_id']; ?>" id="cat_id">
                                <br>
                                <div class="form-floating">
                                    <input type="text" class="form-control" required id="cat_title" value="<?php echo $category['cat_title']; ?>" name="cat_title" placeholder="Enter Category Title">
                                    <label for="cat_title">Category Title</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="inner_container">
                <?php include "header.php"; ?>
                <div id="content">
                    <?php include "header-top.php"; ?>
                    <div class="midde_cont">
                        <div class="container-fluid">
                            <div class="row column_title">
                                <div class="col-md-12">
                                    <div class="page_title">
                                        <h2>Categories Table</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="table_section padding_infor_info">
                                            <div class="table-responsive-sm">
                                                <button type="button" class="model_bt btn cur-p btn-success mb-3" data-toggle="modal" data-target="#myModal">Create Category</button>
                                                <table class="table">
                                                    <?php if (isset($_GET['success'])) { ?>
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            <?php echo $_GET['success']; ?>
                                                        </div>
                                                    <?php } ?>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Category Name</th>
                                                            <th>Active</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $category['cat_id']; ?></td>
                                                            <td><?php echo $category['cat_title']; ?></td>
                                                            <td><?php
                                                                if ($category['is-Active'] == 0) {
                                                                    echo '<h6 style="font-size: 15px;" class=" rounded-pill badge badge-success">Success</h6>';
                                                                } else {
                                                                    echo '<h6 style="font-size: 15px; class=" rounded-pill badge badge-danger">Deleted</h6>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="model_bt btn cur-p btn-warning mb-3" data-toggle="modal" data-target="#editmodal"><i class="fa fa-edit"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- footer -->
                        <div class="container-fluid">
                            <div class="footer">
                                <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
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
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery.fancybox.min.js"></script>
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