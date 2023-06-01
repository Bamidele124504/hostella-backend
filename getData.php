<?php
// Retrieve the student name from the request
$studentName = $_GET['studentName'];

// Create a MySQLi connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hosteltest";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare the query to fetch data from tables based on the student name
$query = "SELECT students.id, students.studentName, rooms.name AS name
          FROM students
          JOIN rooms ON students.room_id = rooms.id
          WHERE students.studentName = '$studentName'";

// Execute the query
$result = mysqli_query($conn, $query);
// Check if the query was successful
if ($result) {
    $studentData = array();
    // Fetch data from the result set
    while ($row = $result->fetch_assoc()) {
        $studentData[] = array(
            'id' => $row['id'],
            'studentName' => $row['studentName'],
            'roomName' => $row['name']
        );

        // Fetch other student names with the same room number
        $roomName = $row['name'];
        $otherStudentNames = array();
        $otherQuery = "SELECT students.studentName
                       FROM students
                       JOIN rooms ON students.room_id = rooms.id
                       WHERE rooms.name = '$roomName'
                       AND students.studentName != '$studentName'";
        $otherResult = mysqli_query($conn, $otherQuery);
        if ($otherResult) {
            while ($row = $otherResult->fetch_assoc()) {
                $otherStudentNames[] = $row['studentName'];
            }
        }

        // Add the other student names to the current student's data
        $studentData[count($studentData) - 1]['otherStudentNames'] = $otherStudentNames;
    }

    // Return the student data as JSON
    header('Content-Type: application/json');
    echo json_encode($studentData);
} else {
    // Query execution failed
    echo "Error: " . $mysqli->error;
}

// Close the MySQLi connection
mysqli_close($conn);
?>
