<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

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

// Fetch subscription plans
$plans_result = $conn->query("SELECT * FROM subscription_plans");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .plan {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            background-color: #f9f9f9;
            flex: 1 1 calc(33.333% - 40px); /* Adjust width to fit three items per row */
            box-sizing: border-box;
        }
        .plan h3 {
            margin: 0 0 10px 0;
        }
        .plan p {
            margin: 5px 0;
        }
        .subscribe-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: blue;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .subscribe-button:hover {
            background-color: black;
        }
        .plans-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
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
                <li><a href="subscribe2.php">SUBSCRIPTION</a></li>
                <li><a href="profile.php">PROFILE</a></li>
                <li>
                    
                </li>
            </ul>
        </div>
    </div>
    
    <div class="container">
        <center><h1>Subscription Plans</h1></center>
        <div class="plans-container">
            <?php while($plan = $plans_result->fetch_assoc()): ?>
                <div class="plan">
                    <h3><?php echo htmlspecialchars($plan['plan_name']); ?></h3>
                    <p><?php echo htmlspecialchars($plan['description']); ?></p>
                    <p><strong>Price:</strong> &#8377; <?php echo htmlspecialchars($plan['price']); ?></p>
                    <a href="payment.php?plan_id=<?php echo $plan['id']; ?>" class="subscribe-button">Subscribe</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
