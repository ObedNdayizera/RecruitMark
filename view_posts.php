<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM Post";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<h2>View Posts</h2>
<a href="add_Post.php">Add Post</a>
<table>
    <tr>
        <th>ID</th>
        <th>Post Name</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['PostId']; ?></td>
        <td><?php echo $row['PostName']; ?></td>
        <td>
            <a href="update_post.php?id=<?php echo $row['PostId']; ?>">Update</a> | 
            <a href="delete_post.php?id=<?php echo $row['PostId']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include 'includes/footer.php'; ?>
