<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay đổi nếu cần
$password = ""; // Thay đổi nếu cần
$dbname = "qiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID câu hỏi từ URL
$id = $_GET['id'];

// Xóa câu hỏi khỏi cơ sở dữ liệu
$sql = "DELETE FROM questions WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Xóa câu hỏi thành công! <a href='list_questions.php'>Quay lại danh sách câu hỏi</a>";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
