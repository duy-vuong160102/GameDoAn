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

// Lấy dữ liệu từ form
$id = $_POST['id'];
$question = $_POST['question'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$correct_answer = $_POST['correct_answer'];

// Cập nhật dữ liệu vào cơ sở dữ liệu
$sql = "UPDATE questions SET question='$question', answer1='$answer1', answer2='$answer2', answer3='$answer3', answer4='$answer4', correct_answer='$correct_answer' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cập nhật câu hỏi thành công! <a href='list_questions.php'>Quay lại danh sách câu hỏi</a>";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
