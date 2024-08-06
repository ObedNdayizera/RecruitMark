<?php
	include "includes/db.php";
	session_start();
	if (!isset($_SESSION['user_id'])) {
	    header("Location: login.php");
	    exit();
	}

	$id = $_GET['id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$candidateId = $_POST['candidate_id'];
		$examDate = $_POST['exam_date'];
		$marks = $_POST['marks'];
		$decision = $marks >= 50 ? "ACCEPTED" : "REJECTED";
	
		$sql = "UPDATE CandidateResult SET C_ID='$candidateId', ExamDate='$examDate', CR_Marks='$marks', CR_Decision='$decision' WHERE CR_Id='$id'";
	
		if ($conn->query($sql) === TRUE) {
			$success = "Result updated successfully";
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	

	$sql = "SELECT * FROM CandidateResult WHERE CR_Id='$id'";
	$result = $conn->query($sql);
	$resultData = $result->fetch_assoc();
	
?>
<?php include "includes/header.php" ?>
<h2>Update Result</h2>
<form method="post" action="">
	<label for="candidate_id">Candidate</label><br>
	<select id="candidate_id" name="candidate_id" required>
		<?php
		$sql = "SELECT * FROM Candidate";
		$candidates = $conn->query($sql);
		while ($row = $candidates->fetch_assoc()) {
			$selected = $row['C_ID'] == $resultData['C_ID'] ? 'selected' : '';
			echo "<option value='" . $row['C_ID'] . "' $selected>" . $row['C_FirstName'] . " " . $row['C_LastName'] . "</option>";
		}
		?>
	</select><br>

	<label for="exam_date">Exam Date</label><br>
	<input type="date" id="exam_date" name="exam_date" value="<?php echo $resultData['ExamDate']; ?>" required><br>

	<label for="marks">Marks</label><br>
	<input type="number" id="marks" name="marks" value="<?php echo $resultData['CR_Marks']; ?>" required><br>

	<input type="submit" value="Update Result">
	<?php if (isset($success)): ?>
		<p style="color:green;"><?php echo $success; ?></p>
	<?php elseif (isset($error)): ?>
		<p style="color:red;"><?php echo $error; ?></p>
	<?php endif; ?>
</form>
<?php include "includes/footer.php" ?>