<?php
if (isset($_SESSION['username'])) {
    header("Location: profile.php");
    exit();
}
session_start();

$servername = "localhost";
$username = "root";
$password = "josh@123";
$dbname = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM admin1 WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login success
        $_SESSION['username'] = $user;
        header("Location:front2.php"); // Redirect to welcome page
        exit();
    } else {
        // Login failed
        $login_error = "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<center>
<head>
    <title>HTML Login Form</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
            line-height: 1.5;
            min-height: 100vh;
            background: #f3f3f3;
            flex-direction: column;
            margin: 0;
        }
        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 10px 20px;
            transition: transform 0.2s;
            width: 500px;
            text-align: center;
        }
        h1 {
            color: blue;
        }

        label {
            display: block;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: left;
            color: #555;
            font-weight: bold;
        }
        input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            border: none;
            color: white;
            cursor: pointer;
            background-color: blue;
            width: 100%;
            font-size: 16px;
        }
        .wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .wrap a {
            margin-left: 10px;
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Login Form</h1>
        <h3>Sign up Details</h3>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Set your Username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Set your Password" required>
            <?php if ($login_error): ?>
                <p style="color: red;"><?php echo $login_error; ?></p>
            <?php endif; ?>
            <div class="wrap">
                <button type="submit">LOGIN</button>
		<h6><a href="adminlogin.php">ADMIN LOGIN</a></h6>
               <h6><a href="regis.php">CREATE ACCOUNT</a></h6>
	       <h6><a href="forget.php">FORGOT PASSWORD</a></h6>
            </div>
        </form>
    </div>
</body>
</center>
</html>