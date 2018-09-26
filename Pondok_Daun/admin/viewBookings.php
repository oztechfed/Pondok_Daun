<?php
	session_start();
	require_once "../files/config.php";
	require_once "../files/auth.php";
	require_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bookings</title>
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
		<div id="inside">
			<form method="post">
				<br/>
				Checking Bookings for:
				<input type="date" name="date">
				<input type="submit" name="dat" value="Get Bookings">
			</form>
		
			<br /><br /><br />
		<?php
			$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
			
			if(isset($_POST['dat']))
			{
				echo "<h1 style='margin:0;'><i>Booking Report</i></h1><br />";
			
				$date = $_POST['date'];
				
				$start = $date . " 00:00:00";
				$end = $date . " 23:59:59";
			
				$query = "
						SELECT BT.bookingID, cast(BT.bookingTimeandDate as time) AS `time`, BT.no_of_ppl, BT.name
						FROM bookingtable AS BT
						WHERE BT.bookingTimeandDate BETWEEN '".$start."' AND '".$end."'
						ORDER BY `bookingID` ASC";
						
				$results = mysqli_query($conn, $query);
				
				echo"
				<table class='tables'>
					<tr>
						<td width='15%'>ID</td>
						<td width='30%'>Customer</td>
						<td width='25%'>No. of People</td>
						<td width='30%'>Time</td>
					</tr>
				</table>";
				while($row = mysqli_fetch_assoc($results)) 
				{
					$id = $row['bookingID'];
					$cust_Name = $row['name'];
					$pax = $row["no_of_ppl"];
					$time = $row['time'];
						
					echo"
					<table class='tables'>
						<tr>
						<td width='15%'>".$id."</td>
						<td width='30%'>".$cust_Name."</td>
						<td width='25%'>".$pax." people</td>
						<td width='30%'>".$time."</td>
						</tr>
					</table>";
				}
			}
		?>
	</div>
    </div>
</body>
</html>