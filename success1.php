
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .success-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: blue;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:hover {
            background-color:blue;
        }
    </style>
</head>
<body>

<div class="success-container">
    <h2>Payment Successful!</h2>
    <p>Thank you for your payment. Your transaction has been completed successfully.</p>
    <a href="front2.php" class="btn">Back to Home</a>
</div>

</body>
</html>
