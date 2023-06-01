<?php
// Connect to MySQL database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hosteltest";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (mysqli_connect_errno()) {
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Get the room ID and student name from the request body
$data = json_decode(file_get_contents('php://input'), true);
$roomId = $data['roomId'];
$studentName = $data['studentName'];

// Insert the student into the database with the associated room ID
$query = "INSERT INTO femalestudents (room_id, studentName) VALUES ('$roomId', '$studentName')";
$result = mysqli_query($conn, $query);

if ($result) {
  echo json_encode(['message' => 'Student allocated successfully']);
} else {
  echo json_encode(['error' => 'Failed to allocate student']);
}

mysqli_close($conn);
?>
