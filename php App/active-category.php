<?php
    include "db_conn.php"; // Include your database connection script

    if (isset($_POST['activedata'])) {
        $cat_id = $_POST['cat_id'];

        $query = "UPDATE categories SET is_Active = 0 WHERE cat_id = :cat_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: category-index.php?success=Data Active successfully");
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            header("Location: category-index.php?success=Activion failed: ' . $errorInfo[2] . '");
            exit();
        }
    }