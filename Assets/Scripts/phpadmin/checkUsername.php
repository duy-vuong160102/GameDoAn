<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['playerName'])) {
    $playerName = $_GET['playerName'];
    $sql = "SELECT * FROM users WHERE playerName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $playerName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["exists" => true]);
    } else {
        echo json_encode(["exists" => false]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "No playerName provided"]);
}

$conn->close();
?>
