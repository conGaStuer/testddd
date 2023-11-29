<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Kết nối đến cơ sở dữ liệu MySQL (Thay đổi thông tin kết nối tùy thuộc vào cấu hình của bạn)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "furniture";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý yêu cầu GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $conn->query("SELECT id, username, password FROM furnitures");
    
    if ($result->num_rows > 0) {
        $users = array();
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
    } else {
        echo json_encode(array("message" => "No users found."));
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $newUsername = $data->username;
    $newPassword = $data->password;

    $stmt = $conn->prepare("INSERT INTO furnitures (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $newUsername, $newPassword);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "User added successfully."));
    } else {
        echo json_encode(array("message" => "Error adding user."));
    }

    $stmt->close();
} 

// Đóng kết nối
$conn->close();
?>
