<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $postId = $_POST['post_id'];

    $sql = "UPDATE Candidate SET 
                C_FirstName='$firstName',
                C_LastName='$lastName',
                C_Gender='$gender',
                C_DateOfBirth='$dob',
                PhoneNumber='$phone',
                PostId='$postId'
            WHERE C_ID='$id'";

    if ($conn->query($sql) === TRUE) {
        $success = "Candidate updated successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM Candidate WHERE C_ID='$id'";
$result = $conn->query($sql);
$candidate = $result->fetch_assoc();

?>

<?php include 'includes/header.php'; ?>
<h2>Update Candidate</h2>
<form method="post" action="">
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" value="<?php echo $candidate['C_FirstName']; ?>" required><br>
    
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $candidate['C_LastName']; ?>" required><br>
    
    <label for="gender">Gender:</label><br>
    <select id="gender" name="gender" required>
        <option value="Male" <?php if ($candidate['C_Gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($candidate['C_Gender'] == 'Female') echo 'selected'; ?>>Female</option>
    </select><br>
    
    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo $candidate['C_DateOfBirth']; ?>" required><br>
    
    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $candidate['PhoneNumber']; ?>" required><br>
    
    <label for="post_id">Post:</label><br>
    <select id="post_id" name="post_id" required>
        <?php
        $sql = "SELECT * FROM Post";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['PostId'] . "'";
            if ($row['PostId'] == $candidate['PostId']) echo ' selected';
            echo ">" . $row['PostName'] . "</option>";
        }
        ?>
    </select><br>
    
    <input type="submit" value="Update Candidate">
    <?php if (isset($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php elseif (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</form>
<?php include 'includes/footer.php'; ?>
