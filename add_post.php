<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$password_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postName = $_POST['post_name'];

    $sql = "INSERT INTO Post (PostName) VALUES ('$postName')";

    if ($conn->query($sql) === TRUE) {
        $success = "Post added successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include 'includes/header.php'; ?>
<h2>Add Post</h2>
<form method="post" action="">
    <label for="post_name">Post Name</label>
    <input type="text" id="post_name" name="post_name" required>
    <input type="submit" value="Add Post">
    <?php if (isset($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php elseif (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</form>
<?php include 'includes/footer.php'; ?>
