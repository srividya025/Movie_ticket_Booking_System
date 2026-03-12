<?php
session_start();
include("db.php");

$booking_id = $_GET['booking_id'] ?? null;

if (!$booking_id) {
    echo "Invalid Booking!";
    exit();
}

$result = mysqli_query(
    $conn,
    "SELECT * FROM bookings WHERE id='$booking_id'"
);

$booking = mysqli_fetch_assoc($result);
$total_amount = $booking['total_amount'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page-center">
        <div class="main-card">

            <h2>💳 Payment</h2>

            <p><strong>Booking ID:</strong> <?php echo $booking_id; ?></p>
            <p><strong>Total Amount:</strong> ₹<?php echo $total_amount; ?></p>

            <form method="POST">
                <button type="submit" name="pay_now" class="btn">
                    Pay ₹<?php echo $total_amount; ?>
                </button>
            </form>

            <?php
            if (isset($_POST['pay_now'])) {

                mysqli_query(
                    $conn,
                    "INSERT INTO payments (booking_id, amount, payment_status)
         VALUES ('$booking_id', '$total_amount', 'Success')"
                );

                echo "<h3 class='success'>✅ Payment Successful!</h3>";
            }
            ?>

        </div>
    </div>

</body>

</html>