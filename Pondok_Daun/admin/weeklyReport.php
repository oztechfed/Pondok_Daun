<?php
	session_start();
	require_once "../files/config.php";
	require_once "../files/auth.php";
	require_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Weekly Report</title>
	<link rel="stylesheet" type="text/css" href="../css/adminMulti.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
		<form method="post">
			Get sales report <br /><i>From</i>:
			<input type="date" name="date1">
			<i>To</i>:
			<input type="date" name="date2">
			<input type="submit" name="dat" value="Get Report">
		</form>
		
		<br /><br /><br />
	<?php
		
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		if(isset($_POST['dat'])){
			echo "<h1 style='margin:0;'><i>Sales Report</i></h1><br />";
			
			$date1 = $_POST['date1'];
			$date2 = $_POST['date2'];
			
			$select = "	SELECT SUM(`orderTotal`) AS `orderTotal`
						FROM `order`
						WHERE `orderDate` BETWEEN '".$date1."' AND '".$date2."'
						ORDER BY `orderID` DESC";
			
			
			$select_query = mysqli_query($conn, $select) or die(mysqli_error($conn));
			
			while($rows = mysqli_fetch_array($select_query))
			{
				$total = $rows['orderTotal'];
				
				echo"
				<table class='tables'>
					<tr>
						<td>Between</td>
						<td>Total</td>
					</tr>
					<tr>
						<td>".$date1." to ".$date2."</td>
						<td>$".$total."</td>
					</tr>
				</table>";
			}
		}
	?>
	</div>
	</div>
	</div>
</body>
</html>