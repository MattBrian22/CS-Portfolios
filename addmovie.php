<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: cine-page.php');
    exit();
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: cine-page.php');
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
    <link rel="icon" type="image/png" href="cine.png">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
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
                    <form action="" method="POST">
                        <input placeholder="Title" type="text" name="movieTitle" required>
                        <input placeholder="Genre" type="text" name="movieGenre" required>
                        <input placeholder="Duration" type="text" name="movieDuration" required>
                        <input placeholder="Release Date" type="date" name="movieRelDate" required>
                        <input placeholder="Director" type="text" name="movieDirector" required>
                        <input placeholder="Actors" type="text" name="movieActors" required>
                        <input placeholder="Trailer URL" type="text" name="trailerURL" required>
                        <input placeholder="Description" type="text" name="DESCRIPTION" required>
                        <br>
                        <label>Add Poster</label>
                        <input type="file" name="movieImg" accept="image/*">
                        <button type="submit" value="submit" name="submit" class="form-btn">Add Movie</button>
                        <?php
if (isset($_POST['submit'])) {
    $insert_query = "INSERT INTO movieTable (
        movieImg,
        movieTitle,
        movieGenre,
        movieDuration,
        movieRelDate,
        movieDirector,
        movieActors,
        mainhall,
        viphall,
        privatehall,
        trailerURL,
        DESCRIPTION) VALUES (
        'img/" . $_POST['movieImg'] . "',
        '" . $_POST["movieTitle"] . "',
        '" . $_POST["movieGenre"] . "',
        '" . $_POST["movieDuration"] . "',
        '" . $_POST["movieRelDate"] . "',
        '" . $_POST["movieDirector"] . "',
        '" . $_POST["movieActors"] . "',
        '" . $_POST["mainhall"] . "',
        '" . $_POST["viphall"] . "',
        '" . $_POST["privatehall"] . "',
        '" . $_POST["trailerURL"] . "',
        '" . $_POST["DESCRIPTION"] . "')";

    // Execute the query and handle the result
    $rs = mysqli_query($con, $insert_query);
    if ($rs) {
        echo "<script>alert('Successfully Submitted');
              window.location.href='addmovie.php';</script>";
        exit();
    }
}
?>
                    </form>
                </div>
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Recent Movies</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>MovieID</th>
                            <th>MovieTitle</th>
                            <th>Movie_Genre</th>
                            <th>Release_date</th>
                            <th>Director</th>
                            <th>More</th>
                            
                        </tr>
                        <tbody>
                            <?php
                            $select = "SELECT * FROM `movietable`";
                            $run = mysqli_query($con, $select);
                            while ($row = mysqli_fetch_array($run)) {
                                $ID = $row['movieID'];
                                $title = $row['movieTitle'];
                                $genre = $row['movieGenre'];
                                $releaseDate = $row['movieRelDate'];
                                $director = $row['movieDirector'];
                            ?>
                                <tr align="center">
                                    <td><?php echo $ID; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $genre; ?></td>
                                    <td><?php echo $releaseDate; ?></td>
                                    <td><?php echo $director; ?></td>
                                    <td><button type="button" class="btn btn-warning" onclick="location.href='editmovie.php?id=<?php echo $ID; ?>'">Edit</button></td>
                                    <!--<td><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></td>-->
                                    <td><button value="Book Now!" type="submit" onclick="" type="button" class="btn btn-danger"><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></button></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>