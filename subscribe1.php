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

$sql = "SELECT subscribe1 FROM admin1 WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($subscribe1);
$stmt->fetch();
$stmt->close();

$alreadySubscribed = $subscribe1 == 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {
    $plan = $_POST['plan'];

    $start_date = date('Y-m-d');
    if ($plan == 'weekly') {
        $end_date = date('Y-m-d', strtotime('+1 week'));
        $cost = 100;
    } elseif ($plan == 'monthly') {
        $end_date = date('Y-m-d', strtotime('+1 month'));
        $cost = 300;
    } elseif ($plan == 'yearly') {
        $end_date = date('Y-m-d', strtotime('+1 year'));
        $cost = 1200;
    }

    $stmt = $conn->prepare("UPDATE admin1 SET subscribe1 = 1, subscription_start = ?, subscription_end = ?, subscription_cost = ?, subscribe = ? WHERE username = ?");
    $stmt->bind_param("ssdss", $start_date, $end_date, $cost, $plan, $username);

    if ($stmt->execute()) {
        header("Location: payment.php?plan=" . urlencode($plan) . "&start_date=" . urlencode($start_date) . "&end_date=" . urlencode($end_date) . "&cost=" . urlencode($cost));
        exit();
    } else {
        $message = "Error updating subscription: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<html>
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
        .plan {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .plan label {
            display: block;
            margin-bottom: 5px;
        }
        .plan input[type="radio"] {
            margin-right: 10px;
        }
        button {
            padding: 12px;
            border-radius: 8px;
            border: none;
            background-color: blue;
            color: white;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alreadySubscribed = <?php echo json_encode($alreadySubscribed); ?>;
            if (alreadySubscribed) {
                alert("You have already subscribed.");
            }
        });
    </script>
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
    <h1>Choose Your Subscription Plan</h1>
    <form action="" method="post">
        <div class="plan">
            <label>
                <input type="radio" name="plan" value="weekly" required> Weekly Plan - 100/week
            </label>
        </div>
        <div class="plan">
            <label>
                <input type="radio" name="plan" value="monthly" required> Monthly Plan - 300/month
            </label>
        </div>
        <div class="plan">
            <label>
                <input type="radio" name="plan" value="yearly" required> Yearly Plan - 1200/year
            </label>
        </div>
        <?php if (isset($message)): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <button type="submit" name="subscribe">Subscribe</button>
    </form>
</div>
</body>
</html>
