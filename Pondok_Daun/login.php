<?php
	session_start();
	require_once "files/config.php";
	require_once "files/auth.php";
?>
	<?php
	if(isset($_POST['email']) and isset($_POST['passwd']))
	{
		$conn = mysqli_connect($server,$usrname, $passwd, $dbname);
		if(!$conn)
		{
			echo "Error: " . mysqli_error($conn);
		}
		
		$username = $_POST['email'];
		$pswd= $_POST['passwd'];
		
		//Creating Query
		$query = "SELECT * FROM `member` WHERE `email` = ?";
	 
		//Preparing Query
		$stmt = mysqli_prepare($conn, $query);
	 
		//Binding Query
		mysqli_stmt_bind_param($stmt, "s", $username);
	 
		//Execute Query
		$success = mysqli_stmt_execute($stmt);
	 
		if($success)
		{	 
			//Get Results
			$result = mysqli_stmt_get_result($stmt);
			//print_r($result);
			$row = mysqli_fetch_array($result);

			if($row) 
			{
				$name = $row['name'];
				$dbpasswd = $row['password'];
			
				$hashed_passwd = crypt($pswd, $dbpasswd);
				echo "<br/>";
				if($dbpasswd === $hashed_passwd)
				{
					if($username == "admin@mail.com")
					{
						login($name);
						header('Location: admin/adminHome.php');
						exit;
					}
					else{
						login($name);
						header('Location: index.php');
						exit;
					}
					
				}
				else
				{
					echo "<h3 align='center'><strong>Incorrect Password</strong></h3>";
					echo "<h3 align='center'><strong><a href='index.php'>Home</a></strong></h3>";
				}
			}
			else
			{
				echo "<h3 align='center'><strong>Check user name</strong></h3>";
				echo "<h3 align='center'><strong><a href='index.php'>Home</a></strong></h3>";
			}
		}
		
	}
 ?>