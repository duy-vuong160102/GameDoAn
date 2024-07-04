<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển</title>
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
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
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
        <h2>Chào mừng, <?php echo $_SESSION['username']; ?>!</h2>
        <a href="list_characters.php"class="btn-back">Quản lí nhân vật</a> |
        <a href="add_question.html"class="btn-back">Thêm câu hỏi mới</a> | 
        <a href="list_questions.php"class="btn-back">Quản lý câu hỏi</a> | 
        <a href="high_scores.html"class="btn-back">Bảng xếp hạng</a> | 
        <a href="logout.php"class="btn-back">Đăng xuất</a>
    </div>
</body>
</html>
