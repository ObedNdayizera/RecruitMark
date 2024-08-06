<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM Post WHERE PostId='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: view_posts.php');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
