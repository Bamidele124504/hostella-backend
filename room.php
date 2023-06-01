<?php
// Assuming you have a database connection established
// Adjust the database connection details according to your setup
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hosteltest";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the rooms and students data from the database
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

$rooms = [];

if ($result->num_rows > 0) {
    // Loop through each room and fetch the allocated students
    while ($row = $result->fetch_assoc()) {
        $room = $row;
        $roomId = $row['id'];

        $studentSql = "SELECT * FROM students WHERE room_id = $roomId";
        $studentResult = $conn->query($studentSql);

        $students = [];

        if ($studentResult->num_rows > 0) {
            // Loop through each allocated student for the room
            while ($studentRow = $studentResult->fetch_assoc()) {
                $students[] = $studentRow;
            }
        }

        $room['students'] = $students;
        $rooms[] = $room;
    }
}

// Close the database connection
$conn->close();

// Send the rooms data as JSON response
header('Content-Type: application/json');
echo json_encode($rooms);
