<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sensor_data";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $location = $status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["api_key"]) && isset($_POST["location"]) && isset($_POST["status"])) {
        $api_key = test_input($_POST["api_key"]);
        if ($api_key == $api_key_value) {
            $location = test_input($_POST["location"]);
            $status = test_input($_POST["status"]);
            
           
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            
            $sql = "INSERT INTO ultrasonic (location, status)
            VALUES ('" . $location . "', '" . $status . "')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        
            $conn->close();
        } else {
            echo "Wrong API Key provided.";
        }
    } else {
        echo "One or more POST parameters are missing.";
    }
} else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
