<?php
session_start();
require_once 'connect.php'; // Kết nối CSDL

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['emaildk'] ?? '';
    $password = $_POST['mkdk'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Lấy người dùng theo email
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // So sánh mật khẩu người dùng nhập với mật khẩu đã hash
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];  // Lưu ID người dùng vào session
                $_SESSION['user_email'] = $email;
                $_SESSION['loggedin'] = true; // Đánh dấu người dùng đã đăng nhập
                
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Mật khẩu không đúng"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Email không tồn tại"]);
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
