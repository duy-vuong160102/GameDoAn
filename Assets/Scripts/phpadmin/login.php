<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Đăng nhập thành công";
        } else {
            echo "Sai mật khẩu";
        }
    } else {
        echo "tài khoản không tồn tại";
    }
}

$conn->close();
?>