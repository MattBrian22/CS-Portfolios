<?php
include "connection.php";
session_start();

// Variables
$fname = $_POST['fName'];
$lname = $_POST['lName'];
$email = $_POST['email'];
$mobile = $_POST['pNumber'];
$theatre = $_POST['theatre'];
$type = $_POST['type'];
$date = $_POST['date'];
$time = $_POST['hour'];
$movieid = $_POST['movie_id'];
$order = "CINE" . rand(10000, 99999999);
$cust = "CUST" . rand(1000, 999999);
$quantity = $_POST['quantity']; // Added quantity variable

// Check if the email exists in the cine_customers table
$query = "SELECT * FROM cine_customers WHERE email = '$email'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Email exists, calculate discount based on customer type
    $row = mysqli_fetch_assoc($result);
    $customerType = $row['member_type'];

    if ($customerType === "regular") {
        $discount = 0.1;
    } elseif ($customerType === "senior") {
        $discount = 0.3;
    } elseif ($customerType === "child") {
        $discount = 0.25;
    } else {
        $discount = 0.0; // Default discount for other customer types
    }
} else {
    // Email not found, default to guest customer type
    $customerType = "guest";
    $discount = 0.0; // Default discount for guest customer
}

// Calculate the amount with discount and quantity based on hall selection
if ($theatre == "main-hall") {
    $ticketPrice = 10.99; // Ticket price for the main hall
} elseif ($theatre == "vip-hall") {
    $ticketPrice = 40.99; // Ticket price for the VIP hall
} elseif ($theatre == "private-hall") {
    $ticketPrice = 25.99; // Ticket price for the private hall
} else {
    // Default ticket price if no hall is selected
    $ticketPrice = 0.0;
}

$txnAmount = ($ticketPrice * $quantity) - (($ticketPrice * $quantity) * $discount);

// Store form data in session variables
$_SESSION['order'] = $order;
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['email'] = $email;
$_SESSION['mobile'] = $mobile;
$_SESSION['theatre'] = $theatre;
$_SESSION['type'] = $type;
$_SESSION['date'] = $date;
$_SESSION['time'] = $time;
$_SESSION['movieid'] = $movieid;
$_SESSION['amount'] = $txnAmount;
$_SESSION['customerType'] = $customerType;
$_SESSION['discount'] = $discount;
$_SESSION['quantity'] = $quantity;
$_SESSION['ticketPrice'] = $ticketPrice;

// Insert the data into bookingtable, including the ticketPrice column
$qry = "INSERT INTO bookingtable(`movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`, `amount`, `ORDERID`, `member_type`, `discounts`, `ticketPrice`, `ticketQuantity`) 
        VALUES ('$movieid', '$theatre', '$type', NOW(), NOW(), '$fname', '$lname', '$mobile', '$email', '$txnAmount', '$order', '$customerType', '$discount', '$ticketPrice', '$quantity')";
$result = mysqli_query($con, $qry);

if ($result) {
    echo "Data inserted successfully.";
} else {
    echo "Error inserting data: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">

  <title>Confirmation Page</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
      color: #333;
      font-size: 28px;
      margin-top: 30px;
      margin-bottom: 20px;
    }

    .container {
      max-width: 500px;
      margin-top: 50px;
      margin-bottom: 50px;
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
      font-weight: bold;
    }

        p {
            margin-bottom: 10px;
        }

        .payment-form {
            margin-top: 20px;
        }

    

        .form-input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

    .btn-pay-now {
      background-color: #dc3545;
      border-color: #dc3545;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Proceed for Payment</h1>

    <form method="post" action="cine-loading.php">
      <div class="form-group row">
        <label for="order-id" class="col-sm-3 col-form-label form-label">Order ID:</label>
        <div class="col-sm-9">
          <input type="text" id="order-id" class="form-control" value="<?php echo $order; ?>" readonly>
          <input type="hidden" name="ORDER_ID" value="<?php echo $order; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label form-label">Name:</label>
        <div class="col-sm-9">
          <input type="text" id="name" class="form-control" value="<?php echo $_POST['fName'] . ' ' . $_POST['lName']; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="website" class="col-sm-3 col-form-label form-label">Website:</label>
        <div class="col-sm-9">
          <input type="text" id="website" class="form-control" value="Cineit" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="theatre" class="col-sm-3 col-form-label form-label">Theatre:</label>
        <div class="col-sm-9">
          <input type="text" id="theatre" class="form-control" value="<?php echo $_POST['theatre']; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="type" class="col-sm-3 col-form-label form-label">Type:</label>
        <div class="col-sm-9">
          <input type="text" id="type" class="form-control" value="<?php echo $_POST['type']; ?>" readonly>
        </div>
      </div>

      
      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label form-label">Quantity:</label>
        <div class="col-sm-9">
          <input type="text" id="name" class="form-control" value="<?php echo $_POST['quantity']; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="txn-amount" class="col-sm-3 col-form-label form-label">Amount paid:</label>
        <div class="col-sm-9">
        <input type="text" id="txn-amount" class="form-control" value="£<?php echo number_format($txnAmount, 2); ?>" readonly>
          <input type="hidden" name="CUST_ID" value="<?php echo $cust; ?>">
          <input type="hidden" name="INDUSTRY_TYPE_ID" value="retail">
          <input type="hidden" name="CHANNEL_ID" value="WEB">
        </div>
      </div>

      <div class="form-group row">
        <label for="member-type" class="col-sm-3 col-form-label form-label">Member Type:</label>
        <div class="col-sm-9">
          <input type="text" id="member-type" class="form-control" value="<?php echo $customerType; ?>" readonly>
        </div>
      </div>

      <div class="form-group">
                <label class="form-label" for="card-name">Cardholder Name</label>
                <input class="form-input" type="text" id="card-name" name="card-name" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="card-number">Card Number</label>
                <input class="form-input" type="text" id="card-number" name="card-number" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="expiry-date">Expiry Date</label>
                <input class="form-input" type="date" id="expiry-date" name="expiry-date" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="cvv">CVV</label>
                <input class="form-input" type="password" id="cvv" name="cvv" required>
            </div>

      <div class="form-group row">
        <div class="col-sm-9 offset-sm-3">
          <button type="submit" class="btn btn-pay-now">Pay Now!</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>