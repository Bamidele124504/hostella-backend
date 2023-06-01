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

// Get the room name from the request body
$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];

// Insert the room into the database
$query = "INSERT INTO adminmessages (message) VALUES ('$message')";
$result = mysqli_query($conn, $query);

mysqli_close($conn);
?>
