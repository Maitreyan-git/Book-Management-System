<?php
    include 'conn.php';	
    $sql = "SELECT bname, image FROM sample1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="book">';
            echo '<img src="' . $row['image'] . '" alt="' . $row['bname'] . '">';
            echo '<h3>' . $row['bname'] . '</h3>';
            
<button class="bttn1">Read More</button></a>';
echo '</div>';
        }
    } else {
        echo "No books found.";
    }

    $conn->close();
echo '</a>';
    ?>