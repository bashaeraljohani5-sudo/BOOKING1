<?php 
include 'db.php'; 
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_id = $_POST['guest_id'];
    $name = $_POST['name'];

    // التحقق الآمن لعدم إظهار أي خطأ برميجي
    if(!empty($guest_id) && !empty($name)) {
        $_SESSION['guest_id'] = $guest_id;
        $_SESSION['guest_name'] = $name;
        // بعد تسجيل الدخول بنجاح، يتم توجيهه تلقائياً لصفحة الحجز
        header("Location: booking.php");
        exit();
    } else {
        $msg = "<div class='alert' style='background-color:#f8d7da; color:#721c24;'>Please enter valid details!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Aura Elite Resort</title>
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
    <h2>Sign In to Your Account</h2>
    <?php echo $msg; ?>
    <form action="" method="POST">
        <label>Guest ID / Username:</label>
        <input type="text" name="guest_id" placeholder="e.g. G001" required>

        <label>Your Name:</label>
        <input type="text" name="name" placeholder="Enter your name" required>

        <button type="submit">Sign In Now</button>
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