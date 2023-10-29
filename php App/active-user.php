<?php
    include "db_conn.php"; // Include your database connection script

    if (isset($_POST['activedata'])) {
        $id = $_POST['id'];

        $query = "UPDATE users SET is_Active = 0 WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: users-index.php?success=Data Active successfully");
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            header("Location: users-index.php?success=Activion failed: ' . $errorInfo[2] . '");
            exit();
        }
    }