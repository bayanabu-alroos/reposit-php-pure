<?php
include "db_conn.php";

$user_id = $_SESSION['id'];
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user['image'] == '') {
        $profile_picture = "
            <img class='img-fluid'
            src='upload/imageProfile/user_icon.png'
            alt='User profile picture'>
        ";
    } else {
        $profile_picture = "
            <img class='img-fluid' width='180' class='img-responsive rounded-circle' style='border-radius: 100% 100%;'
            src='upload/imageProfile/{$user['image']}'
            alt='User profile picture'>
        ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    // Handle the database error as needed
}