<?php 
include 'db.php'; 
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_id = $_POST['guest_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    
    // إدخال البيانات مباشرة في جدول guestdetails الخاص بك
    $sql = "INSERT INTO `guestdetails` (`GuestID`, `GuestName`, `PhoneNumber`, `CheckInDate`, `CheckOutDate`, `Guests`) 
            VALUES ('$guest_id', '$name', '$phone', '0000-00-00', '0000-00-00', '1')";
    
    if ($conn->query($sql) === TRUE) {
        $msg = "<div class='alert'>Account created! <a href='login.php'>Click here to Login</a></div>";
    } else {
        $msg = "<div class='alert' style='background-color:#f8d7da; color:#721c24;'>Error or ID Duplicated!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Aura Elite Resort</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo-container">
        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&auto=format&fit=crop" alt="Logo" class="logo-img">
        <span class="hotel-name">Aura Elite Resort</span>
    </div>
    <nav><a href="index.php">Home</a><a href="booking.php">Rooms & Booking</a><a href="login.php">Login</a><a href="register.php">Register</a></nav>
</header>

<div class="form-wrapper">
    <h2>Create New Account</h2>
    <?php echo $msg; ?>
    <form action="" method="POST">
        <label>Choose Guest ID (e.g., G100):</label>
        <input type="text" name="guest_id" placeholder="Enter unique ID" required>

        <label>Full Name:</label>
        <input type="text" name="name" placeholder="Enter your full name" required>

        <label>Phone Number:</label>
        <input type="text" name="phone" placeholder="Enter phone number" required>

        <button type="submit">Create Account</button>
    </form>
</div>

<footer>
    <p style="font-size: 20px; font-weight: bold; margin-bottom: 5px; color: #f1c40f;">Aura Elite Resort</p>
    <div class="social-links">
        <a href="https://www.instagram.com" target="_blank" class="social-btn instagram">📸 Instagram</a>
        <a href="https://api.whatsapp.com/send?phone=966500000000" target="_blank" class="social-btn whatsapp">💬 WhatsApp</a>
    </div>
</footer>
</body>
</html>