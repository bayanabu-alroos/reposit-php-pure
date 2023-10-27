<?php
include "db_conn.php"; // Include your database connection script

if (isset($_POST['deletedata'])) {
    $product_id = $_POST['product_id'];

    $query = "UPDATE products SET is_Active = 1 WHERE product_id = :product_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: product-index.php?success=Data Deleted successfully");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        header("Location: product-index.php?success=Deletion failed: ' . $errorInfo[2] . '");
        exit();
    }
}
