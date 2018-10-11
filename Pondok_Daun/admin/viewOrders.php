<?php
	session_start();
	require_once "../files/config.php";
	require_once "../files/auth.php";
	require_login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Orders</title>
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
			From:
			<input type="date" name="date1">
			To:
			<input type="date" name="date2">
			<input type="submit" name="dat" value="Get Orders">
		</form>
		
		<br /><br /><br />
	<?php
		
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		if(isset($_POST['dat'])){
			
			$date1 = $_POST['date1'];
			$date2 = $_POST['date2'];
			
			echo "<h1 style='margin:0;'><i>Orders between : ".$date1." and ".$date2."</i></h1><br />";
			
			$select = "	SELECT `order`.`orderDate`, M.name, `order`.`orderType`, `order`.`orderDetails`, `order`.`orderTotal`
						FROM member AS M, `order`
						WHERE `order`.`customerID` = M.memberID
						AND`orderDate` BETWEEN '".$date1."' AND '".$date2."'
						ORDER BY `orderDate` DESC";
			
			
			$select_query = mysqli_query($conn, $select) or die(mysqli_error($conn));
			
			echo"
				<table class='tables'>
					<tr>
						<td width='15%'>Date</td>
						<td width='15%'>Customer</td>
						<td width='10%'>Order Type</td>
						<td width='50%'>Description</td>
						<td width='10%'>Total ($)</td>
					</tr>
				</table>";
			while($rows = mysqli_fetch_array($select_query))
			{
				$date = $rows['orderDate'];
				$description = $rows['orderDetails'];
				$customer = $rows['name'];
				$orderType = $rows['orderType'];
				$total = $rows['orderTotal'];
				
				echo"
				<table class='tables'>
					<tr>
						<td width='15%'>".$date."</td>
						<td width='15%'>".$customer."</td>
						<td width='10%'>".$orderType."</td>
						<td width='50%'>".$description."</td>
						<td width='10%'>$".$total."</td>
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