<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `users` WHERE Userid = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: logout.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
