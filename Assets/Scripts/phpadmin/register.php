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
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $player_name = $_POST["player_name"];

    // Kiểm tra trùng lặp username, email, hoặc player_name
    $checkUserSql = "SELECT * FROM users WHERE username='$username' OR email='$email' OR player_name='$player_name'";
    $result = $conn->query($checkUserSql);

    if ($result->num_rows > 0) {
        echo "Tên đăng nhập, email, tên đã tồn t";
    } else {
        $sql = "INSERT INTO users (username, password, email, player_name) VALUES ('$username', '$password', '$email', '$player_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Đăng kí thành công";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
