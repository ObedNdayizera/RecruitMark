<?php
	include "includes/db.php";
	session_start();
	if (!isset($_SESSION['user_id'])) {
	    header("Location: login.php");
	    exit();
	}

	$sql = "SELECT CandidateResult.*, Candidate.C_FirstName, Candidate.C_LastName 
	FROM CandidateResult 
	JOIN Candidate ON CandidateResult.C_ID = Candidate.C_ID";

	$query = $conn->query($sql);

	$result = mysqli_fetch_all($query, MYSQLI_ASSOC);



?>

<?php include "includes/header.php"; ?>
<h2>View Results</h2>
<a href="add_candidate_result.php">Add Result</a>
<table>
	<tr>
		<th>ID</th>
		<th>Candidate</th>
		<th>Exam Date</th>
		<th>Marks</th>
		<th>Decision</th>
		<th>Actions</th>
	</tr>
	<?php foreach ($result as $row): ?>
		<tr>
			<td><?=$row['CR_Id']?></td>
			<td><?=$row['C_FirstName']?> <?=$row['C_LastName']?></td>
			<td><?=$row['ExamDate']?></td>
			<td><?=$row['CR_Marks']?>%</td>
			<td style="color:<?php echo $row['CR_Decision'] == 'ACCEPTED' ? 'lightgreen' : 'lightcoral'?>"><?=$row['CR_Decision']?></td>
			<td>
				<a href="update_candidate_result.php?id=<?=$row['CR_Id']?>">Update</a> |
				<a href="delete_candidate_result.php?id=<?=$row['CR_Id']?>" onclick="return confirm('Are you sure?');">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<?php include "includes/footer.php" ?>