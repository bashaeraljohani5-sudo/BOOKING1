<?php
$host = "localhost";
$user = "root";
$password = ""; 
$dbname = "booking hotel"; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// تشغيل الـ Session لتذكر العميل عند الانتقال بين الصفحات
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>