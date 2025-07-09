<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You have successfully logged in.</p>
    <a href="front2.php">Go to protected content</a>
</body>
</html>
