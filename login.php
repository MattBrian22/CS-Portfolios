<?php
// login.php

// Replace the placeholder values with your actual database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cinema_db';

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Query the database to check if the email/password combination is valid
    $query = "SELECT * FROM cine_customers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        // Fetch the user details
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Authentication successful
            session_start();
            $_SESSION['email'] = $email;
            
            // Redirect to the member area or home page
            header('Location: cine-page.php');
            exit();
        } else {
            // Authentication failed
            $error = "Invalid email or password.";
        }
    } else {
        // Authentication failed
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="sign-in.css">
   <title>login</title>
</head>
<body>
<div class="login-container">
<?php
// Display error message if authentication failed
if (isset($error)) {
echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
}
?>

<form action="login.php" method="POST">
<label for="email">Email:</label>
<input type="email" id="email" name="email" required>

<label for="password">Password:</label>
<input type="password" id="password" name="password" required>

<button type="submit">Login</button>
</form>
        <p><span class="not-member">Not yet a member?</span> <a href="cust-registration.html">Join for free</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
