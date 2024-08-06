<?php
include "includes/db.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE UserId=$id";
$query = $conn->query($sql);
$user = mysqli_fetch_assoc($query);
?>

<?php include 'includes/header.php'; ?>
<h2>Welcome, <?=$user['UserName'];?> to BEAUTY WAREHOUSE Dashboard</h2>
<p>Select an option from the menu to manage Candidates, Posts, Candidate Results or Generate Reports.</p>
<?php include 'includes/footer.php'; ?>
