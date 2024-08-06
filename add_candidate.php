<?php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$password_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $postId = $_POST['post_id'];

    $sql = "INSERT INTO Candidate (C_FirstName, C_LastName, C_Gender, C_DateOfBirth, PhoneNumber, PostId)
            VALUES ('$firstName', '$lastName', '$gender', '$dob', '$phone', '$postId')";

    if ($conn->query($sql) === TRUE) {
        $success = "New candidate added successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include 'includes/header.php'; ?>
<h2>Add Candidate</h2>
<form method="post" action="">
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" required><br>
    
    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name" required><br>
    
    <label for="gender">Gender:</label><br>
    <select id="gender" name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br>
    
    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" required><br>
    
    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone" required><br>
    
    <label for="post_id">Post:</label><br>
    <select id="post_id" name="post_id" required>
        <?php
        $sql = "SELECT * FROM Post";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['PostId'] . "'>" . $row['PostName'] . "</option>";
        }
        ?>
    </select>
    
    <input type="submit" value="Add Candidate">
    <?php if (isset($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php elseif (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</form>
<?php include 'includes/footer.php'; ?>
