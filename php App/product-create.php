<?php
session_start();
include "db_conn.php"; // Include your database connection



function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_title = $_POST['product_title'];
        $cat_id = $_POST['cat_id'];
        $product_price = $_POST['product_price'];
        $past_price = !empty($_POST['past_price']) ? $_POST['past_price'] : null; // Set to null if empty
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
    
        // Validation (you can add more validation as needed)
        $errors = [];
        if (empty($product_title)) {
            $errors['product_title'] = 'Product Title is required';
        }
        if (empty($product_price)) {
            $errors['product_price'] = 'Product Price is required';
        }
        if (empty($product_desc)) {
            $errors['product_desc'] = 'Product Description is required';
        }
        if (empty($product_keywords)) {
            $errors['product_keywords'] = 'Product Keywords is required';
        }
        if (empty($cat_id)) {
            $errors['cat_id'] = 'Select Category Title is required';
        }
    
        // Add more validation as needed
    
        if (empty($errors)) {
            // Image file handling (upload and save to a directory)
            $product_img1 = $_FILES['product_img1']['name'];
            $product_img2 = $_FILES['product_img2']['name'];
            $product_img3 = $_FILES['product_img3']['name'];
            $product_img4 = $_FILES['product_img4']['name'];
    
            $temp_name1 = $_FILES['product_img1']['tmp_name'];
            $temp_name2 = $_FILES['product_img2']['tmp_name'];
            $temp_name3 = $_FILES['product_img3']['tmp_name'];
            $temp_name4 = $_FILES['product_img4']['tmp_name'];
            move_uploaded_file($temp_name1, "upload/imagesProduct/$product_img1");
            move_uploaded_file($temp_name2, "upload/imagesProduct/$product_img2");
            move_uploaded_file($temp_name3, "upload/imagesProduct/$product_img3");
            move_uploaded_file($temp_name4, "upload/imagesProduct/$product_img4");
    
            // Prepare the SQL query
            $query = "INSERT INTO products (product_title, cat_id, product_img1, product_img2, product_img3, product_img4, product_price, past_price, product_desc, product_keywords) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Use $conn to prepare the statement
            $stmt = $conn->prepare($query);
    
            $stmt->bindParam(1, $product_title);
            $stmt->bindParam(2, $cat_id);
            $stmt->bindParam(3, $product_img1);
            $stmt->bindParam(4, $product_img2);
            $stmt->bindParam(5, $product_img3);
            $stmt->bindParam(6, $product_img4);
            $stmt->bindParam(7, $product_price);
            $stmt->bindParam(8, $past_price);
            $stmt->bindParam(9, $product_desc);
            $stmt->bindParam(10, $product_keywords);
    
            // Execute the query
            if ($stmt->execute()) {
                header("Location: product-index.php?success=Product has been created successfully");
                exit();            
            } else {
                header("Location: product-create.php?error=Product creation failed.");
                exit();
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
                                        <h2>Create Product</h2>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white_shd full margin_bottom_30">
                                        <div class="table_section padding_infor_info">
                                            <div class="table-responsive-sm">
                                                <div class="msg_list_main">
                                                    <form method="post" action="product-create.php" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Product Title">
                                                                    <label for="product_title">Product Title</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['product_title'] ?? ''; ?></span>
                                                            </div>
                                                            <?php
                                                            $query = "SELECT cat_id, cat_title FROM categories";
                                                            $stmt = $conn->prepare($query);
                                                            $stmt->execute();
                                                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            ?>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <select class="form-select" name="cat_id" id="cat_id">
                                                                        <option value="">Select a category</option>
                                                                        <?php
                                                                        foreach ($categories as $category) {
                                                                            echo '<option value="' . $category['cat_id'] . '">' . $category['cat_title'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <label for="floatingSelectGrid">Select Category</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['cat_id'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="file" class="form-control" id="product_img1" name="product_img1" id="product_img1" accept="image/*">
                                                                    <label for="product_img1">Product Image One</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['product_img1'] ?? ''; ?></span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="file" class="form-control"  name="product_img2" id="product_img2" accept="image/*">
                                                                    <label for="product_img2">Product Image Two</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['product_img2'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="file" class="form-control" id="product_img3" name="product_img3"  accept="image/*">
                                                                    <label for="product_img3">Product Image Three</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="file" class="form-control" accept="image/*" id="product_img4" name="product_img4"  accept="image/*">
                                                                    <label for="product_img4">Product Image Four</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Product Price">
                                                                    <label for="product_price">Product Price</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['product_price'] ?? ''; ?></span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="past_price" name="past_price" placeholder=" Past Price  Product">
                                                                    <label for="past_price">Past Product Price</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" id="product_keywords" name="product_keywords" placeholder="Product Keywords">
                                                                    <label for="product_keywords">Product Keywords</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['product_keywords'] ?? ''; ?></span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-floating">
                                                                    <textarea type="text" class="form-control" id="product_desc" name="product_desc" placeholder="Product Description"></textarea>
                                                                    <label for="product_desc">Product Description</label>
                                                                </div>
                                                                <span class="text-danger"><?php echo $errors['product_desc'] ?? ''; ?></span>
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="submit"  class="main_bt mx-5 mt-5 me-5" value="Create Product">
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