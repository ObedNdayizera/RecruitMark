<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postName = $_POST['post_name'];

    $sql = "UPDATE Post SET PostName='$postName' WHERE PostId='$id'";

    if ($conn->query($sql) === TRUE) {
        $success = "Post updated successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM Post WHERE PostId='$id'";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

?>

<?php include 'includes/header.php'; ?>
<h2>Update Post</h2>
<form method="post" action="">
    <label for="post_name">Post Name</label>
    <input type="text" id="post_name" name="post_name" value="<?php echo $post['PostName']; ?>" required>
    <input type="submit" value="Update Post">
    <?php if (isset($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php elseif (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</form>
<?php include 'includes/footer.php'; ?>
