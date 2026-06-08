<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aura Elite Resort - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo-container">
        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=150&auto=format&fit=crop" alt="Resort Logo" class="logo-img">
        <span class="hotel-name">Aura Elite Resort</span>
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="booking.php">Rooms & Booking</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <?php if(isset($_SESSION['guest_id'])): ?>
            <span style="color:#f1c40f; margin-left:15px;">| Hello, <?php echo $_SESSION['guest_name']; ?></span>
        <?php endif; ?>
    </nav>
</header>

<div class="container">
    <div class="hero-section">
        <h1>Welcome to Aura Elite Luxury Resort</h1>
        <p>Experience world-class hospitality, elegant rooms, and unforgettable views.</p>
    </div>

    <h2>Our Premium Spaces</h2>
    <div class="room-grid">
        <div class="room-card"><img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=500&auto=format&fit=crop"  alt="Room 1"></div>
        <div class="room-card"><img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500" alt="Room 2"></div>
        <div class="room-card"><img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=500" alt="Room 3"></div>
    </div>

    <h2 style="margin-top: 40px;">Hotel Specifications & Amenities</h2>
    <div class="features">
        <div class="feature-box">
            <h3>📍 Prime Location</h3>
            <p>Situated in the heart of the city with stunning panoramic sea and skyline views.</p>
        </div>
        <div class="feature-box">
            <h3>🏊 Free Access Pools & Spa</h3>
            <p>Enjoy our Olympic-sized heated swimming pools and premium health spa center.</p>
        </div>
        <div class="feature-box">
            <h3>🍽️ 5-Star Dining</h3>
            <p>Complimentary open buffet breakfast included with all deluxe and suite bookings.</p>
        </div>
    </div>
</div>

<footer>
    <p style="font-size: 20px; font-weight: bold; margin-bottom: 5px; color: #f1c40f;">Aura Elite Resort</p>
    <p>Follow our luxury updates & contact us anytime</p>
    <div class="social-links">
        <a href="https://www.instagram.com" target="_blank" class="social-btn instagram">📸 Instagram</a>
        <a href="https://api.whatsapp.com/send?phone=966500000000" target="_blank" class="social-btn whatsapp">💬 WhatsApp</a>
        <a href="https://x.com" target="_blank" class="social-btn x-twitter">𝕏 X / Twitter</a>
        <a href="https://www.snapchat.com" target="_blank" class="social-btn snapchat">👻 Snapchat</a>
        <a href="https://www.pinterest.com" target="_blank" class="social-btn pinterest">📌 Pinterest</a>
    </div>
    <p style="font-size: 13px; color: #a4b0be; margin-top: 25px;">&copy; 2026 Aura Elite Resort. All Rights Reserved.</p>
</footer>

</body>
</html>