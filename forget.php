<?php
session_start();
$message = "";

$step = 'request'; // Default step is to request the username and email

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_username_email'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Database connection
        $servername = "localhost";
        $db_username = "root";
        $db_password = "josh@123";
        $dbname = "sample";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the user exists with the given username and email
        $stmt = $conn->prepare("SELECT * FROM admin1 WHERE username = ? AND email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, proceed to reset password
            $_SESSION['reset_username'] = $username;
            $step = 'reset'; // Change step to reset password
        } else {
            $message = "Invalid username or email.";
        }

        $stmt->close();
        $conn->close();
    }

    if (isset($_POST['submit_new_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
            if (isset($_SESSION['reset_username'])) {
                $username = $_SESSION['reset_username'];

                // Database connection
                $servername = "localhost";
                $db_username = "root";
                $db_password = "josh@123";
                $dbname = "sample";

                $conn = new mysqli($servername, $db_username, $db_password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Update the user's password (plain text)
                $stmt = $conn->prepare("UPDATE admin1 SET password = ? WHERE username = ?");
                $stmt->bind_param("ss", $new_password, $username);

                if ($stmt->execute()) {
                    // Redirect to login page after successful password reset
                    header("Location: login1.php");
                    exit();
                } else {
                    $message = "Error updating password: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                $message = "Session expired. Please try again.";
                $step = 'request';
            }
        } else {
            $message = "Passwords do not match.";
            $step = 'reset';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget and Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        }
        h1 {
            text-align: center;
            color: #333333; 
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 12px;
            border-radius: 8px;
            border: none;
            background-color: blue; 
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        button:hover {
            background-color: skyblue; 
        }
        .message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Forget and Reset Password</h1>
        <?php if ($step === 'request'): ?>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <button type="submit" name="submit_username_email">Submit</button>
            </form>
        <?php elseif ($step === 'reset'): ?>
            <form action="" method="post">
                <input type="password" name="new_password" placeholder="New Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" name="submit_new_password">Reset Password</button>
            </form>
        <?php endif; ?>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
