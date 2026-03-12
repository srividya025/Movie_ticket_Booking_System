<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM movies");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Movies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page-center">
        <div class="main-card">

            <h2>🎬 Available Movies</h2>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="movie-box">
                    <img src="images/<?php echo $row['image']; ?>" class="poster">
                    <h3><?php echo $row['title']; ?></h3>
                    <p>Price: ₹<?php echo $row['price']; ?></p>

                    <a class="btn" href="book.php?movie_id=<?php echo $row['id']; ?>">
                        🎟 Book Now
                    </a>
                </div>

            <?php } ?>

        </div>
    </div>

</body>

</html>