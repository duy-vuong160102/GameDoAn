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

// Truy vấn lấy thông tin câu hỏi theo ID
$sql = "SELECT * FROM questions WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Câu hỏi không tồn tại";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa câu hỏi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Sửa Câu Hỏi</h2>
        <form action="update_question.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="question">Câu hỏi:</label>
            <textarea id="question" name="question" rows="4" required><?php echo $row['question']; ?></textarea>
            
            <label for="answer1">Đáp án 1:</label>
            <input type="text" id="answer1" name="answer1" value="<?php echo $row['answer1']; ?>" required>
            
            <label for="answer2">Đáp án 2:</label>
            <input type="text" id="answer2" name="answer2" value="<?php echo $row['answer2']; ?>" required>
            
            <label for="answer3">Đáp án 3:</label>
            <input type="text" id="answer3" name="answer3" value="<?php echo $row['answer3']; ?>" required>
            
            <label for="answer4">Đáp án 4:</label>
            <input type="text" id="answer4" name="answer4" value="<?php echo $row['answer4']; ?>" required>
            
            <label for="correct_answer">Đáp án đúng (1-4):</label>
            <input type="number" id="correct_answer" name="correct_answer" min="1" max="4" value="<?php echo $row['correct_answer']; ?>" required>
            
            <input type="submit" value="Cập Nhật Câu Hỏi">
        </form>
        <a href="list_questions.php">Quay lại danh sách câu hỏi</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>
