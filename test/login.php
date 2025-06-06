<?php
session_start();

header("Content-Type: application/json");

// Dữ liệu giả lập – bạn nên kết nối CSDL thực tế
$validUser = "admin";
$validPass = "123456";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $validUser && $password === $validPass) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Sai tài khoản hoặc mật khẩu"]);
}
?>
