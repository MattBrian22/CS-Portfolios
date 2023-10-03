<?php
session_start();

// Check if the session variables are set
if (isset($_SESSION['order']) && isset($_SESSION['fname']) && isset($_SESSION['lname']) && isset($_SESSION['theatre']) && isset($_SESSION['type']) && isset($_SESSION['amount'])) {
    // Retrieve order details from session variables
    $orderID = $_SESSION['order'];
    $firstName = $_SESSION['fname'];
    $lastName = $_SESSION['lname'];
    $theatre = $_SESSION['theatre'];
    $type = $_SESSION['type'];
    $amount = $_SESSION['amount'];
    $quantity = $_SESSION['quantity'];
    // Clear the session variables
    session_unset();
    session_destroy();
} else {
    // Session variables not set, handle the error or redirect to an error page
    // For example:
    echo "Error: Session variables not set.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .home-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .home-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Confirmation</h1>

        <p>Thank you for your order!</p>
        <p>Order ID: <?php echo $orderID; ?></p>
        <p>Name: <?php echo $firstName . ' ' . $lastName; ?></p>
        <p>Theatre: <?php echo $theatre; ?></p>
        <p>Type: <?php echo $type; ?></p>
        <p>Amount: £<?php echo number_format($amount, 2); ?></p>
        <p>Quantity: <?php echo $quantity; ?></p>


        <button class="home-button" onclick="window.location.href = 'cine-page.php';">Go to Home Page</button>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
