<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT cr.*, c.* FROM CandidateResult cr JOIN Candidate c ON cr.C_ID = c.C_ID";

$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>
<h2>Candidate Result Report</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Candidate</th>
        <th>Gender</th>
        <th>Birth Date</th>
        <th>Phone Number</th>
        <th>Exam Date</th>
        <th>Marks</th>
        <th>Decision</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['CR_Id'];?></td>
        <td><?php echo $row['C_FirstName'] . ' ' . $row['C_LastName']; ?></td>
        <td><?php echo $row['C_Gender']; ?></td>
        <td><?php echo $row['C_DateOfBirth']; ?></td>
        <td><?php echo $row['PhoneNumber']; ?></td>
        <td><?php echo $row['ExamDate']; ?></td>
        <td><?php echo $row['CR_Marks']; ?>%</td>
        <td><?php echo $row['CR_Decision']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include 'includes/footer.php'; ?>
