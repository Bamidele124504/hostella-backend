<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hosteltest";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all data from your table
$sql = "SELECT * FROM adminmessages";
$result = $conn->query($sql);

// Create an empty array to hold your data
$data = array();

// Check if there are any rows returned from the database
if ($result->num_rows > 0) {
    // Loop through each row and add it to the $data array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
?>
