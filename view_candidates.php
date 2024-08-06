<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM `candidate`";
$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<h2>View Candidates</h2>
<a href="add_Candidate.php">Add Candidate</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Gender</th>
        <th>Date Of Birth</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['C_ID']; ?></td>
        <td><?php echo $row['C_FirstName']; ?></td>
        <td><?php echo $row['C_LastName']; ?></td>
        <td><?php echo $row['C_Gender']; ?></td>
        <td><?php echo $row['C_DateOfBirth']; ?></td>
        <td><?php echo $row['PhoneNumber']; ?></td>
        <td>
            <a href="update_candidate.php?id=<?php echo $row['C_ID']; ?>">Update</a> | 
            <a href="delete_candidate.php?id=<?php echo $row['C_ID']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include 'includes/footer.php'; ?>
