<?php
session_start();

// Check if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'conn.php';

function hasActiveSubscription($conn, $username) {
    $current_date = date('Y-m-d');
    $stmt = $conn->prepare("SELECT subscription_end FROM admin1 WHERE username = ? AND subscription_end >= ?");
    $stmt->bind_param("ss", $username, $current_date);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

$username = $_SESSION['username'];
$has_subscription = hasActiveSubscription($conn, $username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="external2.css">
    <title>Book Details</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
        }
        .logo {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .navbar ul li {
            display: inline;
            margin-right: 10px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #fff;
        }
        .book-details {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .book-detail {
            margin-bottom: 20px;
        }
        .book-detail img {
            max-width:300px;
            height: auto;
            margin-bottom: 10px;
        }
        .book-detail h3 {
            margin-top: 0;
        }
        .book-detail p {
            margin: 5px 0;
        }
        .bttn1 {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .bttn1:hover {
            background-color: #0056b3;
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
                <li>
                    <div class="search">
                        <form method="GET" action="front2.php">
                            <input class="srch" type="search" name="sr" placeholder="type to search">
                            <button class="btn" type="submit">search</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="book-details">
        <?php
        // Fetch book details
        if (isset($_GET['bname'])) {
            $name = urldecode($_GET['bname']);
            $stmt = $conn->prepare("SELECT bname, image, publication_year, publication_name, author, genre, type, language,overview, pdf FROM sample3 WHERE bname = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<div class="book-detail">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['bname'] . '">';
                echo '<h3>' . $row['bname'] . '</h3>';
                echo '<p><strong>Publication Year:</strong> ' . $row['publication_year'] . '</p>';
                echo '<p><strong>Publication Name:</strong> ' . $row['publication_name'] . '</p>';
                echo '<p><strong>Author:</strong> ' . $row['author'] . '</p>';
                echo '<p><strong>Genre:</strong> ' . $row['genre'] . '</p>';
                echo '<p><strong>Type of Book:</strong> ' . $row['type'] . '</p>';
                echo '<p><strong>language</strong> ' . $row['language'] . '</p>';
                echo '<p><strong>Overview:</strong> ' . $row['overview'] . '</p>';

                if ($has_subscription) {
                    echo '<button class="bttn1" onclick="openPdf()">Read Book</button>';
                    echo '<input type="hidden" id="pdfPath" value="' . $row['pdf'] . '">';
                } else {
                    echo '<p style="color: red;">Please subscribe to read this book.</p>';
                }
                echo '</div>';
            } else {
                echo "No details found for this book.";
            }

            $stmt->close();
        } else {
            echo "No book specified.";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function openPdf() {
            // Retrieve the PDF path from the hidden input
            var pdfPath = document.getElementById('pdfPath').value;
            // Open the PDF in a new tab
            window.open(pdfPath, '_blank');
        }
    </script>
</body>
</html>