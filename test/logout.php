<?php
header('Content-Type: application/json');
session_start();              // Bắt đầu phiên làm việc
session_unset();              // Xóa tất cả biến session
session_destroy();            // Hủy session hoàn toàn

// Trả về JSON hoặc chuyển hướng
echo json_encode([
    "status" => "success",
    "message" => "Đã đăng xuất thành công"
]);

// Nếu bạn muốn chuyển hướng thay vì trả JSON:
// header("Location: DangNhap.html");
// exit();
?>
