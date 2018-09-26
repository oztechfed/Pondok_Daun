<?php
	session_start();
	require_once "../files/config.php";
	require_once "../files/auth.php";
	require_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Caterings</title>
	<link rel="stylesheet" type="text/css" href="../css/adminMulti.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
    <div id="wrapper">
	<div id='nav'>
		<nav>
			<ul>
				<li> <a href="adminHome.php"> Admin Home </a></li>
				<li><a href="editMenu.php"> Menu </a></li>
				<li><a href="viewBookings.php"> Bookings </a></li>
				<li><a href="viewCatering.php"> Catering enquires </a></li>	
				<li><a href="salesReport.php"> Sales Report </a></li>
				<li><a href="viewOrders.php"> View Orders </a></li>
				<li><a href="../index.php"> View Website </a></li>
				<li><a href="editMenu.html"> Edit Website </a></li>			
			</ul>
		</nav>
	</div>
	<div id="content">
	<div id="inside">
		<h1 style="margin:0;"><i>Catering</i></h1>
		<br />
		<?php

			$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
			$query = "
					SELECT C.name, C.description, cast(C.TimeandDate as date) AS `date`, cast(C.TimeandDate as time) AS `time`
					FROM catering AS C
					ORDER BY C.cateringID DESC
					LIMIT 20";
			$results = mysqli_query($conn, $query);
			
			echo"
				<table class='tables'>
					<tr>
						<td width='15%'>Name</td>
						<td width='10%'>Date</td>
						<td width='10%'>Time</td>
						<td width='50%'>Description of Event</td>
					</tr>
				</table>";
			while($row = mysqli_fetch_assoc($results)) 
			{
				$name = $row['name'];
				$descpt =  $row["description"];
				$time = $row['time'];
				$date = $row['date'];
						
				echo"
				<table class='tables'>
					<tr>
						<td width='15%'>".$name."</td>
						<td width='10%'>".$date."</td>
						<td width='10%'>".$time."</td>
						<td width='50%'>".$descpt."</td>
					</tr>
				</table>";
			}
			
		?>
	</div>
	</div>
    </div>
</body>
</html>