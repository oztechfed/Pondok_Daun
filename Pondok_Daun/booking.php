<?php
session_start();
require_once "files/config.php";
require_once "files/auth.php";
?>
<?php
		//Creating Conncetion
		if(isset($_POST['name']) and isset($_POST['pax']) and isset($_POST['dateInput']))
		{
			$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
			if(!$conn)
			{
				die("Couldn't connect: " . mysqli_error($conn));
			}
			
			$title = $_POST['title'];
			$nm = $_POST['name'];
			$name = $title . " " . $nm;
			$pax = $_POST['pax'];
			$date = $_POST['dateInput'];
			$time = $_POST['time'];
			
			$booking =  $date . " " . $time;
			
  
			if (empty($name)) 
			{
				$nameError = "name is required";
			} 
			else 
			{
				//Check Availability
				$availability = mysqli_query($conn,"SELECT * FROM `bookingtable` WHERE bookingTimeandDate = '$booking'");
			  
				$count = mysqli_num_rows($availability);
				if($count >= 3)
				{
					echo "<h3 align='center'><strong>All Tables are Booked Please Try another time.</strong></h3>";
					echo "<h3 align='center'><strong><a href='booking.html'>Home</a></strong></h3>";
				}
				else
				{
						//Creating Query
					$query = "INSERT INTO `bookingtable` (`name`, `no_of_ppl`, `bookingTimeandDate`) 
					VALUES (?, ?, ?)";
		
					//Preparing Query
					$stmt = mysqli_prepare($conn, $query);
		
					//Binding Query
					mysqli_stmt_bind_param($stmt, "sss", $name, $pax, $booking);
			
					//Executing Query
					$success = mysqli_stmt_execute($stmt);
					if($success)
					{
						echo "Your Table has been booked";
						echo "<h4>Back<a href='index.php' style='text-decoration:none;'> Home</a> now!!</h4>";
					}
				}
				
			}	
		}
	?>

