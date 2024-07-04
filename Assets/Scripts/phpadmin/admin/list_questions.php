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

// Truy vấn lấy danh sách câu hỏi
$sql = "SELECT id, question FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách câu hỏi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #5cb85c;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #4cae4c;
        }

        .btn-secondary {
            background-color: #337ab7;
        }

        .btn-secondary:hover {
            background-color: #286090;
        }

        .btn-danger {
            background-color: #d9534f;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .action-links a {
            margin-right: 10px;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #d9534f;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh sách câu hỏi</h2>
        <a href="add_question.html"class="btn-back">Thêm câu hỏi mới</a>
        <a href="dashboard.php" class="btn-back">Quay lại Bảng điều khiển</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Câu hỏi</th>
                <th>Hành động</th>
            </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["question"] . "</td>";
                echo '<td><a href="edit_question.php?id=' . $row["id"] . '">Sửa</a> | <a href="delete_question.php?id=' . $row["id"] . '">Xóa</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Không có câu hỏi nào</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
