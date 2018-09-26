<?php
		require_once "files/config.php";
	?>
	<?php
		
		
		//Creating Conncetion
		if(isset($_POST['email']) and isset($_POST['password']) and isset($_POST['name']))
		{
			$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
			if(!$conn)
			{
				die("Couldn't connect: " . mysqli_error($conn));
			}
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$address = $_POST['address'];
			$contact = $_POST['contact'];
			
  
			if (empty($email)) 
			{
				$emailError = "Email is required";
			} 
			else 
			{
				// check if e-mail address is valid
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					echo "<strong>Invalid email format</strong>";
				}
				else
				{
					if (strlen($password) > 5)
					{
						$userCheck = mysqli_query($conn,"SELECT email FROM `member` WHERE email = '$email'");
			  
						$count = mysqli_num_rows($userCheck);
						if($count != 0)
						{
							echo "<h3 align='center'><strong>Please Use another email.</strong></h3>";
							echo "<h3 align='center'><strong><a href='index.php'>Home</a></strong></h3>";
						}
			
						else
						{
							$salt = '$2y$07$' . base64_encode(openssl_random_pseudo_bytes(32));
							$encrypted = crypt($password, $salt);
		
							//Creating Query
							$query = "INSERT INTO `member` (`name`, `email`, `password`, `address`, `contact`) 
										VALUES (?, ?, '$encrypted', ?, ?)";
		
							//Preparing Query
							$stmt = mysqli_prepare($conn, $query);
		
							//Binding Query
							mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $address, $contact);
			
							//Executing Query
							$success = mysqli_stmt_execute($stmt);
							if($success)
							{
								echo "1 record added";
								header('Location: index.php');
							}
						}
					}
					else
					{
						echo "<h3 align='center'><strong>Invalid Password Length.</strong></h3>";
						echo "<h3 align='center'><strong><a href='index.php'>Home</a></strong></h3>";
						
					}
				}
			}	
		}
	?>