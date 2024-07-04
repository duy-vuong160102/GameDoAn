<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['newPlayerName'])) {
    $username = $_POST['username'];
    $newPlayerName = $_POST['newPlayerName'];

    // Check if new playerName exists
    $sql = "SELECT * FROM users WHERE player_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $newPlayerName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["error" => "Player name already exists"]);
    } else {
        // Update playerName
        $sql = "UPDATE users SET playe_name = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newPlayerName, $username);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "Failed to update player name"]);
        }
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "No username or new player name provided"]);
}

$conn->close();
?>
