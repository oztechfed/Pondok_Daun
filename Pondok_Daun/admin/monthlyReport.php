<?php
	session_start();
	require_once "../files/config.php";
	require_once "../files/auth.php";
	require_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Monthly Report</title>
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
	<div id="content" style="color:red;">
	<div id="inside">
		<form method="post">
			<br/>
			Month: 
			<select name="month">
				<option value="1">January</option>
				<option value="2">February</option>
				<option value="3">March</option>
				<option value="4">April</option>
				<option value="5">May</option>
				<option value="6">June</option>
				<option value="7">July</option>
				<option value="8">August</option>
				<option value="9">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<input type="submit" name="button" value="Get Report">
		</form>
		
		<br /><br /><br />
	<?php
		
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		
		
		if(isset($_POST['button']))
		{
			echo "<h1 style='margin:0;'><i>Monthly Report</i></h1><br />";
			
			$mnth = $_POST['month'];
			
			$monthly = "SELECT MONTHNAME(`orderDate`) AS `Month`, SUM(orderTotal) AS `Total`
						FROM `order`
						WHERE MONTH(`orderDate`) = '".$mnth."'
						GROUP BY YEAR(`orderDate`), MONTH(`orderDate`)";
			
			$monthly_query = mysqli_query($conn, $monthly) or die(mysqli_error($conn));
			
			while($rows = mysqli_fetch_array($monthly_query))
			{
				$month = $rows['Month'];
				$total = $rows['Total'];
				echo"
				<table class='tables'>
				<tr>
						<td>Month</td>
						<td>Total</td>
					</tr>
					<tr>
						<td>".$month."</td>
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