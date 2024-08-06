<?php
include 'includes/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE UserName='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {

            session_regenerate_id();

            $_SESSION['user_id'] = $row['UserId'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid password or username";
        }
    } else {
        echo "Invalid password or username";
    }
}
?>

<?php include 'includes/header.php'; ?>
<h2>Login</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
<?php include 'includes/footer.php'; ?>
