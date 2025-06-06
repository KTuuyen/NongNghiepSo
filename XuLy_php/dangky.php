<?php
session_start();
require_once 'connect.php'; // Đường dẫn tùy theo cấu trúc folder của bạn

// // Lấy dữ liệu từ form
// $fullname = $_POST['tendk'];
// $phone = $_POST['sdtdk'];
// $email = $_POST['emaildk'];
// $password = $_POST['mkdk'];
// $confirmPassword = $_POST['nhaplaimkdk'];

// // Kiểm tra mật khẩu khớp không
// if ($password !== $confirmPassword) {
//     die("❌ Mật khẩu không khớp. Vui lòng thử lại.");
// }

// // Mã hóa mật khẩu
// // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// // Kiểm tra email đã tồn tại chưa
// $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
// $checkEmail->bind_param("s", $email);
// $checkEmail->execute();
// $checkEmail->store_result();

// if ($checkEmail->num_rows > 0) {
//     die("❌ Email đã được sử dụng. Vui lòng dùng email khác.");
// }
// $checkEmail->close();

// // Chuẩn bị dữ liệu mặc định
// $address = ""; // Form của bạn chưa có địa chỉ => để rỗng
// $role_id = 2; // Mặc định là người dùng thường
// $deleted = 0;

// // Thêm người dùng mới vào database
// $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted)
// VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)");

// $stmt->bind_param("sssssis", $fullname, $email, $phone, $address, $password, $role_id, $deleted);

// if ($stmt->execute()) {
//     echo "✅ Đăng ký thành công!";
// } else {
//     echo "❌ Lỗi khi đăng ký: " . $stmt->error;
// }

// $stmt->close();
// $conn->close();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['tendk'];
    $phone = $_POST['sdtdk'];
    $email = $_POST['emaildk'];
    $password = $_POST['mkdk'];
    $confirmPassword = $_POST['nhaplaimkdk'];

    // Thêm các biến còn thiếu
    $address = "";       // giả sử chưa có
    $role_id = 2;        // mặc định role người dùng
    $deleted = 0;        // chưa bị xóa
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if (!empty($fullname) && !empty($email) && !empty($phone) && !empty($password) && !empty($confirmPassword)) {
        if ($password !== $confirmPassword) {
            echo json_encode(["status" => "error", "message" => "Mật khẩu không khớp"]);
            exit;
        }

        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "Email đã tồn tại"]);
        } 
        else {
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)");

            $stmt->bind_param("sssssis", $fullname, $email, $phone, $address, $hashedPassword, $role_id, $deleted);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => $stmt->error]);
            }

            $stmt->close();
        }

        $checkEmail->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Thiếu thông tin"]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Chỉ chấp nhận POST"]);
}

?>
