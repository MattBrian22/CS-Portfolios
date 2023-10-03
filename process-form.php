<?php
// Change the following values to match your MySQL database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cineit";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for any errors in the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data from $_POST
$first_name = $_POST["first-name"];
$last_name = $_POST["last-name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$member_type = $_POST["member_type"];
$password = $_POST["password"];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($member_type === "guest") {
    // Insert the form data into the database for regular member customers
    $sql = "INSERT INTO cine_customers (first_name, last_name, email, password, phone, member_type, is_member, discount) 
    VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$member_type', 1, 0.0)";
  } elseif ($member_type === "regular") {
    // Insert the form data into the database for senior member customers
    $sql = "INSERT INTO cine_customers (first_name, last_name, email, password, phone, member_type, is_member, discount) 
    VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$member_type', 1, 0.1)";
  } elseif ($member_type === "senior") {
    // Insert the form data into the database for senior member customers
    $sql = "INSERT INTO cine_customers (first_name, last_name, email, password, phone, member_type, is_member, discount) 
    VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$member_type', 1, 0.3)";
  } elseif ($member_type === "child") {
    // Insert the form data into the database for child member customers
    $sql = "INSERT INTO cine_customers (first_name, last_name, email, password, phone, member_type, is_member, discount) 
    VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$member_type', 1, 0.25)";
  } else {
    // Invalid member type
    // Redirect to registration page
    header("Location: cust-registration.html");
    exit();
  }
  

if ($conn->query($sql) === TRUE) {
  // Redirect to homepage
  header("Location: cine-page.php");
} else {
  // Display error message
  echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "')</script>";
  // Redirect to registration page
  header("Location: cust-registration.html");
}

// Close the database connection
$conn->close();

?>
