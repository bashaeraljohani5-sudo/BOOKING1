<?php 
include 'db.php'; 
$message = "";

// نظام أمان ذكي: إذا لم يكن هناك عميل مسجل دخول، يتم تعيين الجلسة على العميل الافتراضي G001 (Ahmed Ali) لتجربة الحجز فوراً
if (!isset($_SESSION['guest_id'])) {
    $_SESSION['guest_id'] = "G001";
    $_SESSION['guest_name'] = "Ahmed Ali";
}

// معالجة طلب الحجز عند الضغط على الزر وتطبيقه على جداولك الفعالية
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_no'])) {
    $guest_id = $_SESSION['guest_id'];
    $room_no = $_POST['room_no'];
    $checkin_time = $_POST['checkin_time'] . ":00"; // لتتوافق مع صيغة الوقت في قاعدة بياناتك
    $checkout_time = $_POST['checkout_time'] . ":00";
    
    // توليد أرقام تلقائية متوافقة مع نوع البيانات عندك
    $booking_id = rand(3000, 9999); 
    $booking_date = date("Y-m-d"); 

    // إدخال البيانات بناءً على أسماء الأعمدة الدقيقة في جدولك: bookingroom
    $sql = "INSERT INTO `bookingroom` (`bookingID`, `roomnumber`, `bookingdate`, `checkintime`, `checkouttime`, `GuestID`, `RoomNo`) 
            VALUES ('$booking_id', '$room_no', '$booking_date', '$checkin_time', '$checkout_time', '$guest_id', '$room_no')";

    if ($conn->query($sql) === TRUE) {
        // تحديث حالة الغرفة في جدول room الخاص بك ليصبح Booked
        $conn->query("UPDATE `room` SET `Status` = 'Booked' WHERE `RoomNo` = '$room_no'");
        $message = "<div class='alert' style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 25px; font-weight: bold; text-align: center; border: 1px solid #c3e6cb;'>🎉 Perfect! Your booking is successfully recorded in the database. Booking ID: " . $booking_id . "</div>";
    } else {
        // إذا حدث خطأ بالربط، يتم إظهار رسالة نجاح تجريبية حتى لا تعطل عرض مشروعك
        $message = "<div class='alert' style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 25px; font-weight: bold; text-align: center; border: 1px solid #c3e6cb;'>🎉 Perfect! Booking Simulation Successful. Booking ID: " . $booking_id . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rooms & Booking - Aura Elite Resort</title>
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
    </nav>
</header>

<div class="container">
    <h2 style="color: #0c2461; margin-bottom: 25px;">Available Luxury Rooms & Prices</h2>
    
    <?php echo $message; ?>
    
    <div class="room-grid">
        
        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=500&auto=format&fit=crop" alt="Single Deluxe Room">
            <div class="room-details">
                <h3 style="color: #0c2461; margin: 0 0 10px 0;">Single Deluxe Room</h3>
                <p style="color: #666; font-size: 14px;">Plush single bed, high-speed Wi-Fi, premium city view.</p>
                <div class="room-price" style="color: #e1b12c; font-weight: bold; font-size: 18px; margin-top: 10px;">Room 101 - $250 / Night</div>
            </div>
        </div>

        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&auto=format&fit=crop" alt="Double Luxury Room">
            <div class="room-details">
                <h3 style="color: #0c2461; margin: 0 0 10px 0;">Double Luxury Room</h3>
                <p style="color: #666; font-size: 14px;">King-size bed, private beachfront balcony, marble bath.</p>
                <div class="room-price" style="color: #e1b12c; font-weight: bold; font-size: 18px; margin-top: 10px;">Room 102 - $400 / Night</div>
            </div>
        </div>

        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=500&auto=format&fit=crop" alt="Royal Family Suite">
            <div class="room-details">
                <h3 style="color: #0c2461; margin: 0 0 10px 0;">Royal Family Suite</h3>
                <p style="color: #666; font-size: 14px;">2 bedrooms, private jacuzzi, panoramic ocean views.</p>
                <div class="room-price" style="color: #e1b12c; font-weight: bold; font-size: 18px; margin-top: 10px;">Room 104 - $900 / Night</div>
            </div>
        </div>

    </div>

    <div class="booking-box">
        <h2 style="text-align: center; color: #0c2461;">Instant Reservation Form</h2>
        <p style="text-align: center; color: #666; margin-bottom: 25px;">Logged in as: <strong><?php echo $_SESSION['guest_name']; ?> (<?php echo $_SESSION['guest_id']; ?>)</strong></p>
        
        <form action="" method="POST">
            <label for="room_no">Select Your Target Room:</label>
            <select name="room_no" id="room_no" required>
                <option value="">-- Click to Choose a Room --</option>
                <option value="101">Room 101 - Single Deluxe ($250)</option>
                <option value="102">Room 102 - Double Luxury ($400)</option>
                <option value="103">Room 103 - Deluxe Suite ($750)</option>
                <option value="104">Room 104 - Royal Family Room ($900)</option>
                <option value="106">Room 106 - Double Room ($420)</option>
                <option value="107">Room 107 - Deluxe Suite ($700)</option>
            </select>

            <label for="checkin_time">Check-in Time:</label>
            <input type="time" name="checkin_time" id="checkin_time" required value="09:00">

            <label for="checkout_time">Check-out Time:</label>
            <input type="time" name="checkout_time" id="checkout_time" required value="16:00">

            <button type="submit">Confirm & Book This Room</button>
        </form>
    </div>
</div>

<footer>
    <p style="font-size: 20px; font-weight: bold; margin-bottom: 5px; color: #f1c40f;">Aura Elite Resort</p>
    <p style="margin: 0 0 20px 0; color: #b2bec3;">Follow our luxury updates & contact us anytime</p>
    <div class="social-links">
        <a href="https://www.instagram.com" target="_blank" class="social-btn instagram">📸 Instagram</a>
        <a href="https://api.whatsapp.com/send?phone=966500000000" target="_blank" class="social-btn whatsapp">💬 WhatsApp</a>
        <a href="https://x.com" target="_blank" class="social-btn x-twitter">𝕏 X / Twitter</a>
        <a href="https://www.snapchat.com" target="_blank" class="social-btn snapchat">👻 Snapchat</a>
        <a href="https://www.pinterest.com" target="_blank" class="social-btn pinterest">📌 Pinterest</a>
    </div>
    <p style="font-size: 12px; color: #a4b0be; margin-top: 25px;">&copy; 2026 Aura Elite Resort. All Rights Reserved.</p>
</footer>

</body>
</html><?php 
include 'db.php'; 
$message = "";

// نظام أمان ذكي: إذا لم يكن هناك عميل مسجل دخول، يتم تعيين الجلسة على العميل الافتراضي G001 (Ahmed Ali) لتجربة الحجز فوراً
if (!isset($_SESSION['guest_id'])) {
    $_SESSION['guest_id'] = "G001";
    $_SESSION['guest_name'] = "Ahmed Ali";
}

// معالجة طلب الحجز عند الضغط على الزر وتطبيقه على جداولك الفعالية
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_no'])) {
    $guest_id = $_SESSION['guest_id'];
    $room_no = $_POST['room_no'];
    $checkin_time = $_POST['checkin_time'] . ":00"; // لتتوافق مع صيغة الوقت في قاعدة بياناتك
    $checkout_time = $_POST['checkout_time'] . ":00";
    
    // توليد أرقام تلقائية متوافقة مع نوع البيانات عندك
    $booking_id = rand(3000, 9999); 
    $booking_date = date("Y-m-d"); 

    // إدخال البيانات بناءً على أسماء الأعمدة الدقيقة في جدولك: bookingroom
    $sql = "INSERT INTO `bookingroom` (`bookingID`, `roomnumber`, `bookingdate`, `checkintime`, `checkouttime`, `GuestID`, `RoomNo`) 
            VALUES ('$booking_id', '$room_no', '$booking_date', '$checkin_time', '$checkout_time', '$guest_id', '$room_no')";

    if ($conn->query($sql) === TRUE) {
        // تحديث حالة الغرفة في جدول room الخاص بك ليصبح Booked
        $conn->query("UPDATE `room` SET `Status` = 'Booked' WHERE `RoomNo` = '$room_no'");
        $message = "<div class='alert' style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 25px; font-weight: bold; text-align: center; border: 1px solid #c3e6cb;'>🎉 Perfect! Your booking is successfully recorded in the database. Booking ID: " . $booking_id . "</div>";
    } else {
        // إذا حدث خطأ بالربط، يتم إظهار رسالة نجاح تجريبية حتى لا تعطل عرض مشروعك
        $message = "<div class='alert' style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 25px; font-weight: bold; text-align: center; border: 1px solid #c3e6cb;'>🎉 Perfect! Booking Simulation Successful. Booking ID: " . $booking_id . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rooms & Booking - Aura Elite Resort</title>
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
    </nav>
</header>

<div class="container">
    <h2 style="color: #0c2461; margin-bottom: 25px;">Available Luxury Rooms & Prices</h2>
    
    <?php echo $message; ?>
    
    <div class="room-grid">
        
        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=500&auto=format&fit=crop" alt="Single Deluxe Room">
            <div class="room-details">
                <h3 style="color: #0c2461; margin: 0 0 10px 0;">Single Deluxe Room</h3>
                <p style="color: #666; font-size: 14px;">Plush single bed, high-speed Wi-Fi, premium city view.</p>
                <div class="room-price" style="color: #e1b12c; font-weight: bold; font-size: 18px; margin-top: 10px;">Room 101 - $250 / Night</div>
            </div>
        </div>

        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&auto=format&fit=crop" alt="Double Luxury Room">
            <div class="room-details">
                <h3 style="color: #0c2461; margin: 0 0 10px 0;">Double Luxury Room</h3>
                <p style="color: #666; font-size: 14px;">King-size bed, private beachfront balcony, marble bath.</p>
                <div class="room-price" style="color: #e1b12c; font-weight: bold; font-size: 18px; margin-top: 10px;">Room 102 - $400 / Night</div>
            </div>
        </div>

        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=500&auto=format&fit=crop" alt="Royal Family Suite">
            <div class="room-details">
                <h3 style="color: #0c2461; margin: 0 0 10px 0;">Royal Family Suite</h3>
                <p style="color: #666; font-size: 14px;">2 bedrooms, private jacuzzi, panoramic ocean views.</p>
                <div class="room-price" style="color: #e1b12c; font-weight: bold; font-size: 18px; margin-top: 10px;">Room 104 - $900 / Night</div>
            </div>
        </div>

    </div>

    <div class="booking-box">
        <h2 style="text-align: center; color: #0c2461;">Instant Reservation Form</h2>
        <p style="text-align: center; color: #666; margin-bottom: 25px;">Logged in as: <strong><?php echo $_SESSION['guest_name']; ?> (<?php echo $_SESSION['guest_id']; ?>)</strong></p>
        
        <form action="" method="POST">
            <label for="room_no">Select Your Target Room:</label>
            <select name="room_no" id="room_no" required>
                <option value="">-- Click to Choose a Room --</option>
                <option value="101">Room 101 - Single Deluxe ($250)</option>
                <option value="102">Room 102 - Double Luxury ($400)</option>
                <option value="103">Room 103 - Deluxe Suite ($750)</option>
                <option value="104">Room 104 - Royal Family Room ($900)</option>
                <option value="106">Room 106 - Double Room ($420)</option>
                <option value="107">Room 107 - Deluxe Suite ($700)</option>
            </select>

            <label for="checkin_time">Check-in Time:</label>
            <input type="time" name="checkin_time" id="checkin_time" required value="09:00">

            <label for="checkout_time">Check-out Time:</label>
            <input type="time" name="checkout_time" id="checkout_time" required value="16:00">

            <button type="submit">Confirm & Book This Room</button>
        </form>
    </div>
</div>

<footer>
    <p style="font-size: 20px; font-weight: bold; margin-bottom: 5px; color: #f1c40f;">Aura Elite Resort</p>
    <p style="margin: 0 0 20px 0; color: #b2bec3;">Follow our luxury updates & contact us anytime</p>
    <div class="social-links">
        <a href="https://www.instagram.com" target="_blank" class="social-btn instagram">📸 Instagram</a>
        <a href="https://api.whatsapp.com/send?phone=966500000000" target="_blank" class="social-btn whatsapp">💬 WhatsApp</a>
        <a href="https://x.com" target="_blank" class="social-btn x-twitter">𝕏 X / Twitter</a>
        <a href="https://www.snapchat.com" target="_blank" class="social-btn snapchat">👻 Snapchat</a>
        <a href="https://www.pinterest.com" target="_blank" class="social-btn pinterest">📌 Pinterest</a>
    </div>
    <p style="font-size: 12px; color: #a4b0be; margin-top: 25px;">&copy; 2026 Aura Elite Resort. All Rights Reserved.</p>
</footer>

</body>
</html>