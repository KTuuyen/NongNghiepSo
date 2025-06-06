<?php
session_start();
require_once 'connect.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['ten'];
    $phone = $_POST['sdt'];
    $email = $_POST['email'];
    $address = $_POST['adress'];
    $note = $_POST['note'];
    $total_raw = $_POST['total'];

    // Làm sạch số tiền để đảm bảo kiểu số
    $total = preg_replace('/[^0-9]/', '', $total_raw);

    if (!empty($fullname) && !empty($email) && !empty($phone) && !empty($address) && !empty($total)) {
        // Kiểm tra người dùng tồn tại
        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            $checkEmail->bind_result($userid);
            $checkEmail->fetch();

            // Chuẩn bị câu lệnh chèn đơn hàng
            $stmt = $conn->prepare("INSERT INTO orders (user_id, fullname, email, phone_number, address, note, order_date, total_money)
                                    VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->bind_param("isssssi", $userid, $fullname, $email, $phone, $address, $note, $total);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Thanh toán không thành công."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Email không tồn tại trong hệ thống."]);
        }

        $checkEmail->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Thiếu thông tin."]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Chỉ chấp nhận phương thức POST."]);
}
?>