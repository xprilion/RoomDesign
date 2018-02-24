<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=roomdesign", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
	
// define variables and set to empty values
$name =  $email = $phone = $message  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
  $email = test_input(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
  $phone = test_input(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
  $message = test_input(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
	}

try {
	
	$sql = "INSERT INTO contacts (name,email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
		$conn->exec($sql);
		echo "New record created successfully";
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

