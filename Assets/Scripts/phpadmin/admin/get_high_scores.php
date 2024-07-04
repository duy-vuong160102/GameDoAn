<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Kết nối thất bại: ' . $conn->connect_error]));
}

$sql = "SELECT id, display_name,diem FROM usergame ORDER BY diem DESC LIMIT 10";
$result = $conn->query($sql);

$characters = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $characters[] = $row;
    }
}

$conn->close();

echo json_encode($characters);
?>
