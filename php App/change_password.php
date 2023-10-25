<?php
session_start();

$username="root";
$password="123456789";
$servername="localhost";
$database="online_store";
$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if (isset($_POST['change_client_password'])) {
    $password = sha1(md5($_POST['password']));
    $user_id = $_SESSION['id'];
    //insert unto certain table in database
    $query = "UPDATE users  SET password=? WHERE  id=?";
    $stmt = $mysqli->prepare($query);
    //bind paramaters
    $rc = $stmt->bind_param('ss', $password, $user_id);
    $stmt->execute();
    //declare a varible which will be passed to alert function
    if ($stmt) {
        header("Location: profile.php?success=Password Updated is successfully");
            exit();
    } else {
        header("Location: profile.php?error=Please Try Again Or Try Late");
        exit();
    }
}


