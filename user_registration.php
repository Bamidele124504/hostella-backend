<?php
// Connect to the database
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "hosteltest";
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


    $EncodedData=file_get_contents("php://input");
    $DecodedData=json_decode($EncodedData,true);

// Get the POST data from the client
    $name = $DecodedData['name'];
    $matricnumber =$DecodedData['matricnumber'];
    $pass = $DecodedData['pass'];
    $email = $DecodedData['email'];

// Check if user already exists
$sql = "SELECT * FROM userdetails WHERE matricnumber='$matricnumber'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // User already exists, return error response
  $Response = array("success" => false, "message" => "User already exists");
  echo json_encode($Response);
} else {
  // Insert data into database
  $sql = "INSERT INTO userdetails (name, matricnumber, pass, email) VALUES ('$name', '$matricnumber', '$pass', '$email')";
if ($conn->query($sql) === TRUE) {
  $Response = array("success" => true);
  echo json_encode($Response);
} else {
  $Response = array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error);
  echo json_encode($Response);
}
}

$conn->close();
	
?>


