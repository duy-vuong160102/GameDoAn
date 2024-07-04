<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admins WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "Sai mật khẩu. <a href='login.html'>Thử lại</a>";
    }
} else {
    echo "Tên đăng nhập không tồn tại. <a href='login.html'>Thử lại</a>";
}

$conn->close();
?>
