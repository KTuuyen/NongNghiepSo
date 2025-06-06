<?php
$host = "localhost";
$dbname = "qlnns";     // 🔁 Đổi tên database của bạn ở đây
$username = "root";
$password = "";               // Mật khẩu MySQL (nếu có thì điền vào)

$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
