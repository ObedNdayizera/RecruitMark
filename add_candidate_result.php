<?php 
	include "includes/db.php";
	session_start();
	if (!isset($_SESSION['user_id'])) {
	    header("Location: login.php");
	    exit();
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$candidateId = $_POST['candidate_id'];
		$examDate = $_POST['exam_date'];
		$marks = $_POST['marks'];
		$decision = $marks >= 50 ? "ACCEPTED" : "REJECTED";
		
		$sql = "INSERT INTO CandidateResult (C_ID, ExamDate, CR_Marks, CR_Decision) VALUES ('$candidateId', '$examDate', '$marks', '$decision')";
	
		if ($conn->query($sql) === TRUE) {
			$success = "Result added successfully";
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>
<?php include "includes/header.php" ?>
<h2>Add Candidate Result</h2>
        <form method="post" action="">
            <label for="candidate_id">Candidate:</label><br>
            <select id="candidate_id" name="candidate_id" required>
                <?php
                $sql = "SELECT * FROM Candidate";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['C_ID'] . "'>" . $row['C_FirstName'] . " " . $row['C_LastName'] . "</option>";
                }
                ?>
            </select><br>

            <label for="exam_date">Exam Date:</label><br>
            <input type="date" id="exam_date" name="exam_date" required><br>

            <label for="marks">Marks:</label><br>
            <input type="number" id="marks" name="marks" required><br>

            <input type="submit" value="Add Result">
            <?php if (isset($success)): ?>
                <p style="color:green;"><?php echo $success; ?></p>
            <?php elseif (isset($error)): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
<?php include "includes/footer.php" ?>