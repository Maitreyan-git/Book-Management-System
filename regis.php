<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
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
      margin-top: 20px;
    }
    label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
    }
    input[type=text], input[type=email], input[type=password] {
      width: calc(100% - 24px); 
      padding: 10px 12px;
      margin-bottom: 10px;
      border: 1px solid #dddddd;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }
    button {
      width: 100%;
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
  </style>
</head>
<body>
  <div class="container">
    <h1>REGISTRATION</h1>
    <form action="" method="post">
      <div>
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="mytxt1" required>
      </div>
      <div>
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="mytxt2" required>
      </div>
      <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="mytxt3" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="mytxt4" required>
      </div>
      <div>
        <label for="age">Age</label>
        <input type="text" id="age" name="mytxt5" required>
      </div>
      <div>
        <label for="phone">Phone No</label>
        <input type="text" id="phone" name="mytxt6" required>
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="mytxt7" required>
      </div>
      <div>
        <label for="country">Country</label>
        <input type="text" id="country" name="mytxt8" required>
      </div>
      <button type="submit" name="mysubmit">CREATE ACCOUNT</button>
    </form>
  </div>
</body>
</html>

<?php
if (isset($_POST['mysubmit'])) {
    $firstname = $_POST['mytxt1'];
    $lastname = $_POST['mytxt2'];
    $username = $_POST['mytxt3'];
    $password = $_POST['mytxt4'];
    $age = $_POST['mytxt5'];
    $phoneno = $_POST['mytxt6'];
    $email = $_POST['mytxt7'];
    $country = $_POST['mytxt8'];

    $con = mysqli_connect("localhost", "root", "josh@123", "sample");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO admin1 (firstname, lastname, username, password, age, phoneno  , email, country) VALUES ('$firstname', '$lastname', '$username', '$password', '$age', '$phoneno', '$email', '$country')";

    if (mysqli_query($con, $query)) {
        echo "New record created successfully";
        header("Location: login1.php"); // Redirect to the next page
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
