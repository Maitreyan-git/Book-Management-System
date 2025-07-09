<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="external2.css">
    <title>E-BOOK</title>
    <style>
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
        .content {
            display: flex;
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .filter-section {
            width: 200px;
            margin-right: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
            align-self: flex-start;
        }
        .filter-section div {
            margin-bottom: 20px;
        }
        .book-container {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 30px;
        }
        .book {
            width: 200px;
            margin: 10px;
            padding: 35px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            float: left;
        }
        .book img {
            max-width: 100%;
            height: 200px; /* Fix this to have a consistent height */
            margin-bottom: 10px;
        }
        .book h3 {
            margin-top: 0;
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
        .srch {
            font-family: 'times new roman';
            width: 200px;
            height: 40px;
            background: transparent;
            border: 1px solid;
            margin-top: 13px;
            border-right: none;
            color: white;
            font-size: 16px;
            float: left;
            padding: 10px;
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
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
                        <form method="GET" action="">
                            <input class="srch" type="search" name="sr" placeholder="Search by book name or genre">
                            <button class="btn" type="submit">Search</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
   <div class="content">
        <div class="filter-section">
            <form method="GET" action="">
                <div>
                    <h3>Genre</h3>
                    <label><input type="radio" name="genre" value="Fiction" <?php echo (isset($_GET['genre']) && $_GET['genre'] == 'Fiction') ? 'checked' : ''; ?>> Fiction</label><br>
                    <label><input type="radio" name="genre" value="Non-Fiction" <?php echo (isset($_GET['genre']) && $_GET['genre'] == 'Non-Fiction') ? 'checked' : ''; ?>> Non-Fiction</label><br>
 		   

                  
                    <button class="btn" type="submit"> Genre</button>
                </div>
            </form>
            <form method="GET" action="">
                <div>
                    <h3>Language</h3>
                    <label><input type="radio" name="language" value="English" <?php echo (isset($_GET['language']) && $_GET['language'] == 'English') ? 'checked' : ''; ?>> English</label><br>
                    <label><input type="radio" name="language" value="Spanish" <?php echo (isset($_GET['language']) && $_GET['language'] == 'Spanish') ? 'checked' : ''; ?>> Spanish</label><br>
                    <label><input type="radio" name="language" value="French" <?php echo (isset($_GET['language']) && $_GET['language'] == 'French') ? 'checked' : ''; ?>> French</label><br>
                    <label><input type="radio" name="language" value="tamil" <?php echo (isset($_GET['language']) && $_GET['language'] == 'tamil') ? 'checked' : ''; ?>> Tamil</label><br>
                    <!-- Add more languages as needed -->
                    <button class="btn" type="submit">language</button>
                </div>
            </form>
        </div>
        <div class="book-container">
            <?php
            include 'conn.php';

            $search = isset($_GET['sr']) ? $_GET['sr'] : '';
            $selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : '';
            $selectedLanguage = isset($_GET['language']) ? $_GET['language'] : '';

            $sql = "SELECT sample1.bname, sample1.image FROM sample1 
                    LEFT JOIN sample3 ON sample1.bname = sample3.bname";
            $params = [];
            $types = '';

            $conditions = [];

            if ($search) {
                $conditions[] = "(sample1.bname LIKE ? OR sample3.genre LIKE ?)";
                $search_param = '%' . $search . '%';
                $params[] = $search_param;
                $params[] = $search_param;
                $types .= 'ss';
            }

            if (!empty($selectedGenre)) {
                $conditions[] = "sample3.type = ?";
                $params[] = $selectedGenre;
                $types .= 's';
            }

            if (!empty($selectedLanguage)) {
                $conditions[] = "sample3.language = ?";
                $params[] = $selectedLanguage;
                $types .= 's';
            }

            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }

            $stmt = $conn->prepare($sql);

            if ($types) {
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="book">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['bname'] . '">';
                    echo '<h3>' . $row['bname'] . '</h3>';
                    echo '<a href="bookdet.php?bname=' . urlencode($row['bname']) . '"><button class="bttn1">Read More</button></a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No books found.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
