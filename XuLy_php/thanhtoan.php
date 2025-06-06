<?php
session_start();
require_once 'connect.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Bạn chưa đăng nhập"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ho = $_POST['ho'] ?? '';
    $tendem = $_POST['tendem'] ?? '';
    $ten = $_POST['ten'] ?? '';
    $phone = $_POST['stdtk'] ?? '';
    $email = $_POST['emaildk'] ?? '';

    $fullname = trim($ho . ' ' . $tendem . ' ' . $ten);

    if (!empty($fullname) && !empty($email) && !empty($phone)) {
        $stmt = $conn->prepare("SELECT id, fullname, email, phone_number FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            echo json_encode(["status" => "success", "message" => "Đã ghi nhận người dùng"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Không tìm thấy người dùng!"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Thiếu thông tin"]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Chỉ chấp nhận POST"]);
}
?>