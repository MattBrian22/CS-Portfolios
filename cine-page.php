<!DOCTYPE html>
<head>
	<title>Cineit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Home-movie.css">
    <script src="https://kit.fontawesome.com/881d1397e2.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "connection.php";
    $sql = "SELECT * FROM movieTable";
    ?>

<header>
	  <nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#"><img src="Cine.png"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	        <a class="nav-link" id="home-section-1" href="#home-section-1">Featured Movies</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="about-cineit.html">About Us</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="reviews.html">Reviews</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Now Booking</a>
	      </li>
          <li class="nav-item">
	        <a class="nav-link" href="login.php">Sign In</a>
	      </li>
	    </ul>
	  </div>
	</nav>
</body>
    <div id="home-section-1" class="movie-show-container">
        <h1>Currently Showing</h1>
        <h3>Book a movie now</h3>

        <div class="movie-list">

            <?php
            if ($result = mysqli_query($con, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="movie-box">';
                        echo '<img src="' . $row['movieImg'] . '" alt=" ">';
                        echo '<div class="movie-info ">';
                        echo '<h3>' . $row['movieTitle'] . '</h3>';
                        echo '<a href="booking.php?id=' . $row['movieID'] . '" class = "book-now"> Book a Ticket </a>';
                        echo '</div>';
                        echo '</div>';
                    }
                    mysqli_free_result($result);
                } else {
                    echo '<h4 class="no-annot">No Booking to our movies right now</h4>';
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }

            // Close connection
            mysqli_close($con);
            ?>
        </div>
    </div>

    <footer>
    <div class="footer-container">
        <div class="social-links">
            <h3>Follow Cineit</h3>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </div>
        <div class="About Cineit">
            <h3>About Cineit</h3>
            <p><a href="employees-page.html">Employees Page</a></p>
            <p>Phone: 555-555-5555</p>
            <p>Email: info@cineit.com</p>
        </div>
        <div class="newsletter">
            <h3>Stay up to date with Cineit</h3>
            <form action="#" method="post">
                <input type="email" name="email" placeholder="Your email address">
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <p> If you have any Questions or Concerns, Feel Free to Reach Out To Cineit's Customer Support Team At 0800 123 4567 During Our Operating Hours of 9:00am to 10:00pm, Seven Days a Week</p>
        <p>&copy;All rights reserved Cineit Cinemas 2023 @.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>