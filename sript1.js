document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
   
    const cardName = document.getElementById('cardName').value;
    const cardNumber = document.getElementById('cardNumber').value;
    const expiryDate = document.getElementById('expiryDate').value;
    const cvv = document.getElementById('cvv').value;

    // Basic validation
    if (!validateCardName(cardName)) {
        alert('Please enter a valid cardholder name.');
        return;
    }

    if (!validateCardNumber(cardNumber)) {
        alert('Please enter a valid card number.');
        return;
    }

    if (!validateExpiryDate(expiryDate)) {
        alert('Please enter a valid expiry date in MM/YY format.');
        return;
    }

    if (!validateCVV(cvv)) {
        alert('Please enter a valid CVV.');
        return;
    }

    alert('Payment details are valid!');
});

function validateCardName(name) {
    return name.trim().length > 0;
}

function validateCardNumber(number) {
    return /^\d{16}$/.test(number); // Check if the number is exactly 16 digits
}

function validateExpiryDate(date) {
    const regex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
    return regex.test(date);
}

function validateCVV(cvv) {
    return /^\d{3}$/.test(cvv); // Check if the CVV is exactly 3 digits
}
