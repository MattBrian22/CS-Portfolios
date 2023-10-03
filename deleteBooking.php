<?php
$id = $_GET['id'];
include "config.php";

// Retrieve the booking details
$select_booking_query = "SELECT * FROM bookingTable WHERE bookingID = $id";
$booking_result = mysqli_query($con, $select_booking_query);

if (mysqli_num_rows($booking_result) > 0) {
    $booking_row = mysqli_fetch_assoc($booking_result);
    $movieID = $booking_row['movieID'];

    // Retrieve the current ticket availability for the movie
    $select_movie_query = "SELECT ticket_availability FROM movieTable WHERE movieID = '$movieID'";
    $movie_result = mysqli_query($con, $select_movie_query);

    if (mysqli_num_rows($movie_result) > 0) {
        $movie_row = mysqli_fetch_assoc($movie_result);
        $currentAvailability = $movie_row['ticket_availability'];

        // Update the ticket availability for the movie
        $update_query = "UPDATE movieTable SET ticket_availability = $currentAvailability + 1 WHERE movieID = '$movieID'";
        $result = mysqli_query($con, $update_query);

        if ($result) {
            // Delete the booking entry
            $delete_booking_query = "DELETE FROM bookingTable WHERE bookingID = $id";
            $delete_result = mysqli_query($con, $delete_booking_query);

            if ($delete_result) {
                // Movie deleted and booking entry removed successfully
                // Redirect to a desired page or display a success message
                echo "<script>alert('Customer deleted and booking entry removed successfully');
                      window.location.href = 'view.php';</script>";
                exit();
            } else {
                // Error occurred while removing the booking entry
                // Redirect to a desired page or display an error message
                echo "<script>alert('Error: Unable to remove booking entry');
                      window.location.href = 'view.php';</script>";
                exit();
            }
        } else {
            // Error occurred while updating the ticket availability
            // Redirect to a desired page or display an error message
            echo "<script>alert('Error: Unable to update ticket availability');
                  window.location.href = 'view.php';</script>";
            exit();
        }
    } else {
        // No movie found for the booking
        // Redirect to a desired page or display an error message
        echo "<script>alert('Error: No movie found for the booking');
              window.location.href = 'addmovie.php';</script>";
        exit();
    }
} else {
    // No booking entry found
    // Redirect to a desired page or display an error message
    echo "<script>alert('Error: No booking entry found');
          window.location.href = 'addmovie.php';</script>";
    exit();
}
?>
