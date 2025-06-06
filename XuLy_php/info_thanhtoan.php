<?php
session_start();
require_once 'connect.php'; // kết nối CSDL
header('Content-Type: application/json');

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Chưa đăng nhập"]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Truy vấn thông tin người dùng
$stmt = $conn->prepare("SELECT fullname, email, phone_number FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    echo json_encode(["status" => "success", "data" => $user]);
} else {
    echo json_encode(["status" => "error", "message" => "Không tìm thấy người dùng"]);
}

$stmt->close();
$conn->close();
?>
