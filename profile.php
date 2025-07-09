<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username_db = "root";
$password_db = "josh@123";
$dbname = "sample";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM admin1 WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
            margin: 0;
            padding: 0;
        }
        .main {
            display: flex;
            justify-content: center; /* Center align the items horizontally */
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
        }
        .logo {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            margin-right: auto; /* Move logo to the left */
        }
        .navbar {
            display: flex;
            justify-content: center; /* Center align the navigation items */
            flex-grow: 1; /* Allow the navbar to take up remaining space */
        }
        .navbar ul {
            list-style-type: none;
            margin: 30;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        .navbar ul li {
            display: inline;
            margin: 0 10px; /* Adjust spacing between menu items */
        }
        .navbar ul li a {
            text-decoration: none;
            color: #fff;
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
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="icon">
        <h2 class="logo">E-BOOK</h2>
    </div>
    <div class="navbar">
        <ul>
            <li><a href="about.html">ABOUT US</a></li>
            <li><a href="front2.php">BOOK SHELF</a></li>
            <li><a href="subscribe1.php">SUBSCRIPTION</a></li>
            <li><a href="profile.php">PROFILE</a></li>
        </ul>
    </div>
</div>
<div class="container">
    <h1>User Profile</h1>
    <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phoneno']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Country:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
    <p><strong>Subscription Plan:</strong> <?php echo htmlspecialchars($user['subscribe']); ?></p>
    <p><strong>Subscription Start:</strong> <?php echo htmlspecialchars($user['subscription_start']); ?></p>
    <p><strong>Subscription End:</strong> <?php echo htmlspecialchars($user['subscription_end']); ?></p>
	<p><strong>Cost:</strong> <?php echo htmlspecialchars($user['subscription_cost']); ?></p>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
