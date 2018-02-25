<!DOCTYPE html>
<html>
    <head>
        <title>Room Design</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
	        <div class="row text-center">
                <div class="col-sm-6 col-sm-offset-3">
                <br><br> <h2 style="color:#0fad00">A Message to Moon!</h2>
                <h3>Hey there!</h3>
                <?php
                    $servername = "localhost";
                    $username = "csemelan_dyauser";
                    $password = "!oQpEU,+p7iA";
					
					//print_r($_POST);
					
					function post_captcha($user_response) {
						$fields_string = '';
						$fields = array(
							'secret' => '6LedZUgUAAAAABXr1IRaZLV3onXmG6RZQXXOfZVh',
							'response' => $user_response
						);
						foreach($fields as $key=>$value)
						$fields_string .= $key . '=' . $value . '&';
						$fields_string = rtrim($fields_string, '&');

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
						curl_setopt($ch, CURLOPT_POST, count($fields));
						curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

						$result = curl_exec($ch);
						
						curl_close($ch);

						return json_decode($result, true);
					}

					// Call the function post_captcha
					$res = post_captcha($_POST['g-recaptcha-response']);
					
					//print_r($res);

					if (!$res['success']) {
						die("In-correct captcha response. Please try again.");
					}
                    
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
                    		echo "<br>Your message has been intercepted by our super-cool-from-the-future-interceptors and we'll be responding from our super-cool-email-broadcasters shortly!<br><br>";
                    	}
                    catch(PDOException $e)
                        {
                        echo $sql . "<br>" . $e->getMessage();
                        }
                    
                    $conn = null;
                    ?>
                <a href="index.html" class="btn btn-success"> Go back to Home </a>
                <br><br>
            </div>
    	</div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
