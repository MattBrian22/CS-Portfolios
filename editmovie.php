<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: cine-page.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: cine-page.php');
}

// Check if movie ID is provided in the URL
if (isset($_GET['id'])) {
    $movieID = $_GET['id'];

    // Fetch the movie details from the database
    $select_query = "SELECT * FROM movieTable WHERE movieID = '$movieID'";
    $result = mysqli_query($con, $select_query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Assign the movie details to variables
        $movieTitle = $row['movieTitle'];
        $movieGenre = $row['movieGenre'];
        $movieDuration = $row['movieDuration'];
        $movieRelDate = $row['movieRelDate'];
        $movieDirector = $row['movieDirector'];
        $movieActors = $row['movieActors'];
        $trailerURL = $row['trailerURL'];
        $DESCRIPTION = $row['DESCRIPTION'];
        // Handle the form submission for updating the movie details
        if (isset($_POST['submit'])) {
            // Retrieve the updated values from the form
            $movieTitle = $_POST['movieTitle'];
            $movieGenre = $_POST['movieGenre'];
            $movieDuration = $_POST['movieDuration'];
            $movieRelDate = $_POST['movieRelDate'];
            $movieDirector = $_POST['movieDirector'];
            $movieActors = $_POST['movieActors'];
            $trailerURL = $_POST['trailerURL'];
            $DESCRIPTION = $_POST['DESCRIPTION'];


            // Update the movie details in the database
            $update_query = "UPDATE movieTable SET
                movieTitle = '$movieTitle',
                movieGenre = '$movieGenre',
                movieDuration = '$movieDuration',
                movieRelDate = '$movieRelDate',
                movieDirector = '$movieDirector',
                movieActors = '$movieActors',
                trailerURL = '$trailerURL',
                DESCRIPTION = '$DESCRIPTION'
                WHERE movieID = '$movieID'";

            $result = mysqli_query($con, $update_query);

            if ($result) {
                // Movie details updated successfully
                echo "<script>alert('Movie details updated successfully');
                      window.location.href = 'addmovie.php';</script>";
                exit();
            } else {
                // Error occurred while updating movie details
                echo "<script>alert('Error: Unable to update movie details');
                      window.location.href = 'addmovie.php';</script>";
                exit();
            }
        }
    } else {
        // Movie not found in the database
        echo "<script>alert('Error: Movie not found');
              window.location.href = 'addmovie.php';</script>";
        exit();
    }
} else {
    // Movie ID not provided in the URL
    echo "<script>alert('Error: Invalid request');
          window.location.href = 'addmovie.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php
    $sql = "SELECT * FROM bookingTable";
    $bookingsNo = mysqli_num_rows(mysqli_query($con, $sql));
    $moviesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM movieTable"));
    ?>

    <?php include('admin-header.php'); ?>

    <div class="admin-container">

        <?php include('admin-dashboard.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">


                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Movies</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>
                    <h1>Edit Movie</h1>
                    <form action="" method="POST">
                        <input type="text" name="movieTitle" value="<?php echo $movieTitle; ?>" required>
                        <input type="text" name="movieGenre" value="<?php echo $movieGenre; ?>" required>
                        <input type="text" name="movieDuration" value="<?php echo $movieDuration; ?>" required>
                        <input type="date" name="movieRelDate" value="<?php echo $movieRelDate; ?>" required>
                        <input type="text" name="movieDirector" value="<?php echo $movieDirector; ?>" required>
                        <input type="text" name="movieActors" value="<?php echo $movieActors; ?>" required>
                        <input type="text" name="trailerURL" value="<?php echo $trailerURL; ?>" required>
                        <input type="text" name="DESCRIPTION" value="<?php echo $DESCRIPTION; ?>" required>
                        <button type="submit" name="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
