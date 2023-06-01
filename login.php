<?php
header('Content-Type: application/json');

// Connect to the database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hosteltest";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$EncodedData=file_get_contents("php://input");
$DecodedData=json_decode($EncodedData,true);

// Get the POST data from the client
$matricnumber =$DecodedData['matricnumber'];
$pass = $DecodedData['pass'];
// Check if user exists
$sql = "SELECT * FROM userdetails WHERE matricnumber='$matricnumber' AND pass='$pass'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $Response = array("success" => true);
  echo json_encode($Response);
} else {
  $Response = array("success" => false);
  echo json_encode($Response);
}

$conn->close();
?>




