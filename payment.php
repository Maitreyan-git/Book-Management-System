<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Module</title>
<style>
  body {
    font-family: Arial, sans-serif;
    padding: 20px;
  }
  label {
    display: block;
    margin-bottom: 10px;
  }
  input, select {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
  }
  button {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }
  button:hover {
    background-color: #45a049;
  }
  .payment-details {
    display: none;
  }
</style>
<script>
  function showPaymentDetails() {
    var method = document.getElementById("paymentMethod").value;
    var details = document.getElementsByClassName("payment-details");

    for (var i = 0; i < details.length; i++) {
      details[i].style.display = "none";
    }

    document.getElementById(method).style.display = "block";
  }
</script>
</head>
<body>

<h2>Choose Payment Method</h2>

<?php
$plan = isset($_GET['plan']) ? $_GET['plan'] : '';
$subscription_cost = 0;

if ($plan == 'weekly') {
    $subscription_cost = 100;
} elseif ($plan == 'monthly') {
    $subscription_cost = 300;
} elseif ($plan == 'yearly') {
    $subscription_cost = 1200;
}
?>

<p>Selected Subscription Plan: <strong><?php echo htmlspecialchars($plan); ?></strong></p>
<p>Cost: <strong><?php echo htmlspecialchars($subscription_cost); ?></strong></p>

<form id="paymentForm" action="" method="POST">
  <input type="hidden" name="plan" value="<?php echo htmlspecialchars($plan); ?>">
  <input type="hidden" name="amount" value="<?php echo htmlspecialchars($subscription_cost); ?>">

  <label for="paymentMethod">Select Payment Method:</label>
  <select id="paymentMethod" name="paymentMethod" onchange="showPaymentDetails()">
    <option value="credit_debit">Credit/Debit Card</option>
    <option value="netbanking">Netbanking</option>
    <option value="upi">UPI (Unified Payments Interface)</option>
  </select>

  <div id="credit_debit" class="payment-details">
    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" name="cardNumber" placeholder="Enter your card number" maxlength="16" required>
    <label for="expiryDate">Expiry Date:</label>
    <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" maxlength="3" required>
  </div>

  <div id="netbanking" class="payment-details">
    <label for="bankName">Bank Name:</label>
    <input type="text" id="bankName" name="bankName" placeholder="Enter your bank name" required>
    <label for="accountNumber">Account Number:</label>
    <input type="text" id="accountNumber" name="accountNumber" placeholder="Enter your account number" maxlength="14" required>
    <label for="ifscCode">IFSC Code:</label>
    <input type="text" id="ifscCode" name="ifscCode" placeholder="Enter IFSC code" maxlength="11" required>
  </div>

  <div id="upi" class="payment-details">
    <label for="upiId">UPI ID:</label>
    <input type="text" id="upiId" name="upiId" placeholder="Enter your UPI ID" required>
  </div>

  <br>
  <a href="process_payment.html">proceed to pay</a>
</form>
<script src="script1.js"></script>
</body>
</html>
