<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // Start the session
$id = $_GET['id'];

// Condition to check if movie ID is not provided
if (!$id) {
    echo "<script>alert('You are not supposed to come here directly');window.location.href='cine-page.php';</script>";
    exit();
}

include "connection.php";
$movieQuery = "SELECT * FROM movieTable WHERE movieID = $id";
$movieImageById = mysqli_query($con, $movieQuery);
$row = mysqli_fetch_array($movieImageById);
// Get the trailer URL from the movieTable
$trailerURL = isset($row['trailerURL']) ? $row['trailerURL'] : '';

// ii. Cart Management
if (isset($_POST['add_to_cart'])) {
    $ticketDetails = array(
        'movie_id' => $id,
        'theatre' => $_POST['theatre'],
        'type' => $_POST['type'],
        'date' => $_POST['date'],
        'hour' => $_POST['hour'],
        'fName' => $_POST['fName'],
        'lName' => $_POST['lName'],
        'pNumber' => $_POST['pNumber'],
        'email' => $_POST['email']
    );


    // Check if the cart session variable is already set
    if (isset($_SESSION['cart'])) {
        // Add the new ticket details to the existing cart array
        $_SESSION['cart'][] = $ticketDetails;
    } else {
        // Create a new cart array with the first ticket details
        $_SESSION['cart'] = array($ticketDetails);
    }

    // Redirect the user back to the movie page after adding to cart
    header("Location: cine-page.php?id=$id");
    exit();
}

// vi. Check ticket availability
$ticketAvailabilityQuery = "SELECT ticket_availability FROM movieTable WHERE movieID = $id";
$ticketAvailabilityResult = mysqli_query($con, $ticketAvailabilityQuery);

// Check for errors
if ($ticketAvailabilityResult === false) {
    // Handle error: query failed
    echo "Error: Failed to execute query: " . mysqli_error($con);
    exit;
}
$ticketAvailabilityRow = mysqli_fetch_array($ticketAvailabilityResult);
$availableTickets = $ticketAvailabilityRow['ticket_availability'];

// Decrease ticket availability count in the database if tickets are available
if ($availableTickets > 0) {
 $updateTicketAvailabilityQuery = "UPDATE movieTable SET ticket_availability = ticket_availability - 1 WHERE movieID = $id";
 mysqli_query($con, $updateTicketAvailabilityQuery);
 $isTicketsAvailable = true; // Tickets are available
} else {
 $isTicketsAvailable = false; // Tickets are not available
}

// Change the text of the "Book Now" button to "Sold Out" and disable it if tickets are sold out
if (!$isTicketsAvailable) {
 echo "<script>document.getElementById('bookNowButton').innerHTML = 'Sold Out'; document.getElementById('bookNowButton').disabled = true;</script>";
}




?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book <?php echo $row['movieTitle']; ?> Now</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="bookings.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
</head>

<body style="background-color:#f4cb01;">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="Cine.png" alt="Movie Theater"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="home-section-1" href="#home-section-1">Featured Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Theaters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <?php if (!empty($trailerURL)) { ?>
                <div class="trailer-clip">
                    <?php
                    $video_id = substr($trailerURL, strpos($trailerURL, "=") + 1);
                    $embed_url = "https://www.youtube.com/embed/" . $video_id;
                    ?>
                    <iframe width="560" height="315" src="<?php echo $embed_url; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            <?php } else { ?>
                <p>No trailer available</p>
            <?php } ?>
            
            <div class="movie-box">
                <?php echo '<img src="' . $row['movieImg'] . '" alt="">'; ?>
            </div>
        </div>
            <div class="col-lg-6">
                <h1 class="mb-4"><?php echo $row['movieTitle']; ?></h1>
                <div class="movie-information">
                    <table class="table table-bordered">
                        <tr>
                            <td>GENRE</td>
                            <td><?php echo $row['movieGenre']; ?></td>
                        </tr>
                        <tr>
                            <td>DURATION</td>
                            <td><?php echo $row['movieDuration']; ?></td>
                        </tr>
                        <tr>
                            <td>RELEASE DATE</td>
                            <td><?php echo $row['movieRelDate']; ?></td>
                        </tr>
                        <tr>
                            <td>DIRECTOR</td>
                            <td><?php echo $row['movieDirector']; ?></td>
                        </tr>
                        <tr>
                            <td>ACTORS</td>
                            <td><?php echo $row['movieActors']; ?></td>
                        </tr>
                        <tr>
                            <td>DESCRIPTION</td>
                            <td><?php echo $row['DESCRIPTION']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="booking-form-container">
    <form action="verify.php?id=<?php echo $id; ?>" method="POST">
        <select name="theatre" required>
            <option value="" disabled selected>THEATRE</option>
            <option value="main-hall">Main Hall</option>
            <option value="vip-hall">VIP Hall</option>
            <option value="private-hall">Private Hall</option>
        </select>

        <select name="type" required>
            <option value="" disabled selected>TYPE</option>
            <option value="3d">3D</option>
            <option value="4dx">4DX</option>
            <option value="imax">IMAX</option>
            <option value="2d">2D</option>
        </select>

        <select name="date" required>
            <option value="" disabled selected>DATE</option>
            <option value="May 13, 2023">May 13, 2023</option>
            <option value="May 14, 2023">May 14, 2023</option>
            <option value="May 15, 2023">May 15, 2023</option>
            <option value="May 16, 2023">May 16, 2023</option>
            <option value="May 17, 2023">May 17, 2023</option>
        </select>

        <select name="hour" required>
            <option value="" disabled selected>TIME</option>
            <option value="09:00 AM">09:00 AM</option>
            <option value="12:00 PM">12:00 PM</option>
            <option value="03:00 PM">03:00 PM</option>
            <option value="06:00 PM">06:00 PM</option>
            <option value="09:00 PM">09:00 PM</option>
            <option value="10:30 PM">10:30 PM</option>
        </select>

        <input placeholder="First Name" type="text" name="fName" required>
        <input placeholder="Last Name" type="text" name="lName">
        <input placeholder="Phone Number" type="text" name="pNumber" required>
        <input placeholder="Email" type="email" name="email" required>
        <input type="hidden" name="movie_id" value="<?php echo $id; ?>">
        
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
        
        <button type="submit" name="add_to_cart" class="form-btn" <?php echo ($isTicketsAvailable ? "" : "disabled"); ?>>
            <?php echo ($isTicketsAvailable ? "Book Now" : "Sold Out"); ?>
        </button>
    </form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>