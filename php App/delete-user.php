<?php
include "db_conn.php"; // Include your database connection script

if (isset($_POST['deletedata'])) {
    $id = $_POST['id'];

    $query = "UPDATE users SET is_Active = 1 WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: users-index.php?success=Data Inactive successfully");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        header("Location: users-index.php?success=Deletion failed: ' . $errorInfo[2] . '");
        exit();
    }
}
