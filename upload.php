<?php

$uploaddir = 'image/';
$time=md5(time());
$nname=$time.'.jpg';
$allow=array('jpg','jpeg','png','bmp');

$uploadfile = $uploaddir . $nname;

$extension = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
	if(!in_array(strtolower($extension), $allow)){
	
	echo '{"status":"error"}';
		exit;
	}

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  ///echo "File is valid, and was successfully uploaded.\n";
           header("location: last.html");

} else {
   echo "Upload failed";
}


$servername = "localhost";
$username = "csemelan_dyauser";
$password = "!oQpEU,+p7iA";

try {
    $conn = new PDO("mysql:host=$servername;dbname=csemelan_dya", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
	
// define variables and set to empty values
$name =  $email = $phone = $disc  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
  $email = test_input(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
  $phone = test_input(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
  $disc = test_input(filter_input(INPUT_POST, 'disc', FILTER_SANITIZE_STRING));
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
	}

try {
	
	$sql = "INSERT INTO entries (name,email, phone, disc, time) VALUES ('$name', '$email', '$phone', '$disc', '$nname')";
		$conn->exec($sql);
		//echo "New record created successfully";
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
