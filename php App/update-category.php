<?php
include "db_conn.php"; // Include your database connection script

if (isset($_POST['updatedata'])) {
    $cat_id = $_POST['cat_id'];
    $cat_title = $_POST['cat_title'];

    $query = "UPDATE categories SET cat_title = :cat_title WHERE cat_id = :cat_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cat_title', $cat_title, PDO::PARAM_STR);
    $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: category-index.php?success=Data Updated successfully");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        header("Location: category-index.php?error=Update failed: " . $errorInfo[2]);
        exit();
    }
}
?>

