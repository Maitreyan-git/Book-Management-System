<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
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

// Fetch user details from the database
$result = $conn->query("SELECT * FROM admin1");

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 1400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
        .logout {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>USER DETAILS</h1>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Subscription Plan</th>
			<th>Subscription Start</th>
			<th>Subscription End</th>
			<th>Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><?php echo htmlspecialchars($row['phoneno']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['country']); ?></td>
                            <td><?php echo htmlspecialchars($row['subscribe']); ?></td>
				<td><?php echo htmlspecialchars($row['subscription_start']); ?></td>
			<td><?php echo htmlspecialchars($row['subscription_end']); ?></td>
			<td><?php echo htmlspecialchars($row['subscription_cost']); ?></td>
				
			
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="admin_logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
