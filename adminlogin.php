<?php
session_start();

if (isset($_SESSION['admin_username'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "josh@123";
$dbname = "admin_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_user = isset($_POST['admin_username']) ? $_POST['admin_username'] : '';
    $admin_pass = isset($_POST['admin_password']) ? $_POST['admin_password'] : '';

    if (!empty($admin_user) && !empty($admin_pass)) {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $admin_user, $admin_pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['admin_username'] = $admin_user;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $login_error = "Invalid username or password";
        }

        $stmt->close();
    } else {
        $login_error = "Both fields are required";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        h1 { text-align: center; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { width: 100%; padding: 10px; background-color: blue; color: white; border: none; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form method="post">
            <label for="admin_username">Username:</label>
            <input type="text" id="admin_username" name="admin_username" required>
            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" required>
            <?php if ($login_error): ?>
                <p class="error"><?php echo $login_error; ?></p>
            <?php endif; ?>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
