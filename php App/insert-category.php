<?php
include "db_conn.php";

$errors = array(); // Initialize an array to store validation errors


if (isset($_POST['insertdata'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $cat_title = validate($_POST['cat_title']);

    // Validate the form input
    if (empty($cat_title)) {
        $errors['cat_title'] = 'Category Title is required';
    }

    // Check if there are validation errors
    if (empty($errors)) {
        // No validation errors, proceed with database insertion
        $stmt = $conn->prepare("INSERT INTO categories (cat_title) VALUES (:cat_title)");
        $stmt->bindParam(':cat_title', $cat_title);
        $stmt->execute();

        header("Location: category-index.php?success=Category created successfully");
        exit();
    }
}
