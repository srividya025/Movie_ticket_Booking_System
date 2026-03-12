<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$movie_id = $_GET['movie_id'] ?? null;

if (!$movie_id) {
    echo "Invalid Movie!";
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM movies WHERE id='$movie_id'");
$movie = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page-center">
        <div class="main-card">

            <h2>🎟 Book Tickets</h2>

            <img src="images/<?php echo $movie['image']; ?>" class="poster">

            <p><strong><?php echo $movie['title']; ?></strong></p>
            <p>Price per ticket: ₹<?php echo $movie['price']; ?></p>

            <form method="POST">

                <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">

                <label>Number of Tickets</label>
                <input type="number" name="quantity" min="1" required>

                <button type="submit" name="confirm_booking" class="btn">
                    Confirm Booking
                </button>

            </form>

            <?php
            if (isset($_POST['confirm_booking'])) {

                $user_id = $_SESSION['user_id'];
                $quantity = $_POST['quantity'];
                $price = $movie['price'];
                $total = $price * $quantity;

                $insert = mysqli_query(
                    $conn,
                    "INSERT INTO bookings (user_id, show_id, quantity, total_amount)
         VALUES ('$user_id', '$movie_id', '$quantity', '$total')"
                );

                if ($insert) {
                    $booking_id = mysqli_insert_id($conn);
                    header("Location: payment.php?booking_id=$booking_id");
                    exit();
                } else {
                    echo mysqli_error($conn);
                }
            }
            ?>

        </div>
    </div>

</body>

</html>