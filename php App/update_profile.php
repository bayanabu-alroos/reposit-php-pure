<?php
session_start();
$dsn = "mysql:host=localhost;dbname=online_store";
$username = "root";
$password = "123456789";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['submit'])) {
    try {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $name = validate($_POST['name']);
        $uname = validate($_POST['uname']);
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "upload/imageProfile/";  // Specify the directory where you want to store the uploaded images
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                } else {
                    echo "Error uploading image.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.";
            }
        }
        $sql = "UPDATE users SET user_name = ?, name = ?, email = ?, phone = ?, image = ?, address = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $uname, PDO::PARAM_STR);
        $stmt->bindParam(2, $name, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);
        $stmt->bindParam(4, $phone, PDO::PARAM_STR);
        $stmt->bindParam(5, $fileName, PDO::PARAM_STR);
        $stmt->bindParam(6, $address, PDO::PARAM_STR);
        $stmt->bindParam(7, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            header("Location: profile.php?success= Updated profile is  successfully");
            exit();
        } else {
            header("Location: profile.php?error=Update profile failed". $stmt->errorInfo());
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}