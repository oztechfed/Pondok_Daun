<?php
session_start();
require_once "files/config.php";
require_once "files/auth.php";
?>
<?php
		
		//Creating Conncetion
		if(isset($_POST['name']) and isset($_POST['description']) and isset($_POST['dateInput']))
		{
			$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
			if(!$conn)
			{
				die("Couldn't connect: " . mysqli_error($conn));
			}
			
			$title = $_POST['title'];
			$nm = $_POST['name'];
			$name = $title . " " . $nm;
			$description = $_POST['description'];
			$date = $_POST['dateInput'];
			$time = $_POST['time'];
			
			$booking =  $date . " " . $time;
			
  
			if (empty($name)) 
			{
				$nameError = "name is required";
			} 
			else 
			{
				//Creating Query
				$query = "INSERT INTO `catering` (`name`, `description`, `TimeandDate`) 
				VALUES (?, ?, ?)";
		
				//Preparing Query
				$stmt = mysqli_prepare($conn, $query);
		
				//Binding Query
				mysqli_stmt_bind_param($stmt, "sss", $name, $description, $booking);
			
				//Executing Query
				$success = mysqli_stmt_execute($stmt);
				if($success)
				{
					echo "Your Order is succesfull. We will contact you asap.";
					echo "<h4>Back<a href='index.php' style='text-decoration:none;'> Home</a> now!!</h4>";
				}
				
			}	
		}
?>
