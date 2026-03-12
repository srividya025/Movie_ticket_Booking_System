<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="home-container">
        <h1>Welcome
            <?php echo $_SESSION['user_name']; ?> 🎬
        </h1>
        <p>Movie Ticket Booking System</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

</body>

</html>