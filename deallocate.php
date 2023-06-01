<?php

// Assuming you are using PHP and MySQL for the server-side implementation

// Establish a connection to your MySQL database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hosteltest";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the roomId and studentId from the request parameters
$roomId = $_GET['roomId'];
$studentId = $_GET['studentId'];

// Query to deallocate the student from the room
$sql = "DELETE FROM students WHERE studentName = '$studentId'";

if ($conn->query($sql) === TRUE) {
  // Deallocation successful
  echo "Student deallocated successfully";
} else {
  // Deallocation failed
  echo "Error deallocating student: " . $conn->error;
}

$conn->close();

?>

