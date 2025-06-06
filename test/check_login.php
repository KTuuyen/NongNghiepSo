<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo json_encode(["status" => "success", "email" => $_SESSION['user_email']]);
} else {
    echo json_encode(["status" => "error"]);
}
?>
