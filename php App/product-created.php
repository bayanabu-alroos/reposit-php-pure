<?php
// Database connection
include "db_conn.php";

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
        $errors[] = 'Product Title is required';
    }
    if (empty($product_price)) {
        $errors[] = 'Product Price is required';
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
            echo "<script>window open('index.php?view_products','_self')</script>";
        } else {
            echo "<p>Error inserting the product.</p>";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>


<!-- HTML Form -->
<!DOCTYPE html>
<html>

<head>
    <!-- Your HTML head content here -->
</head>

<body>
    <form method="post" action="product-created.php" enctype="multipart/form-data">
        <label for="product_title">Product Title:</label>
        <input type="text" name="product_title" id="product_title" required>
        <br><br>
        <?php
        $query = "SELECT cat_id, cat_title FROM categories";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label for="cat">Category:</label>
        <select class="form-select" name="cat_id" id="cat_id">
            <option value="">Select a category</option>
            <?php
            foreach ($categories as $category) {
                echo '<option value="' . $category['cat_id'] . '">' . $category['cat_title'] . '</option>';
            }
            ?>
        </select>
        <br><br>

        <label for="product_price">Product Price:</label>
        <input type="text" name="product_price" id="product_price" required>
        <br><br>

        <label for="past_price">Past Product Price:</label>
        <input type="text" name="past_price" id="past_price">
        <br><br>

        <label for="product_desc">Product Description:</label>
        <textarea name="product_desc" id="product_desc" required></textarea>
        <br><br>

        <label for="product_keywords">Product Keywords:</label>
        <input type="text" name="product_keywords" id="product_keywords" required>
        <br><br>

        <label for="product_img1">Product Image 1:</label>
        <input type="file" name="product_img1" id="product_img1" accept="image/*" required>
        <br><br>

        <label for="product_img2">Product Image 2:</label>
        <input type="file" name="product_img2" id="product_img2" accept="image/*">
        <br><br>

        <label for="product_img3">Product Image 3:</label>
        <input type="file" name="product_img3" id="product_img3" accept="image/*">
        <br><br>
        <label for="product_img4">Product Image 4:</label>
        <input type="file" name="product_img4" id="product_img4" accept="image/*">
        <br><br>

        <input type="submit" name="submit" value="Add Product">
    </form>
</body>

</html>
