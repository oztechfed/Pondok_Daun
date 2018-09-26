<!DOCTYPE html5>
<html>
<head>
	<title>Order Confirmed</title>
	
	<link rel="stylesheet" type = "text/css" href = "css/menu.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

<script>
//Script for closing and opening the drop down menu
	function myFunction(id)
	{
		var divelement = document.getElementById(id);
		if(divelement.style.display == 'none')
		{
			divelement.style.display = 'block';
		}
		else
		{
			divelement.style.display = 'none';
		}
	}
</script>

<script>
	function added()
	{
		alert("Added to cart");
	}
</script>
</head>
<body>
<div id = "wrapper">
	<div id = "nav">
			<nav>
			<ul>
				<li style="float:right; padding:0;"><a href = "signup.html" style="padding:0;"><img src="images/login.png" style="height:45px; width:60px; float:right; padding:0"></a></li>
				<li><a href="index.php"> Home </a></li>
				<li><a href="booking.html"> Catering </a></li>
				<li><a href="booking.html"> Booking </a></li>	
				<li><a href="order_cart.php"> Cart </a></li>			
			</ul>
			</nav>
			
	</div>
	<div id = "content">
		<div id = "left">
			<div class = "section">
				<h3 style="color:black;"> Place </h3>
			</div>
			<div class = "section">
				<h3><a href="menu.php" style="color:black;"> Menu </a></h3>
			</div>
		</div>
		<div id = "right">
			<div id = "selection" style="width:100%; margin-top:15px; background-color:white; padding:5%;">
				<p align="center">
				<button id="btn" class="dropbtn">Order Discarded</button>
			</div>
		<?php
		require_once "files/config.php";
	
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		
		$discard = "DELETE FROM `shoppingcart`";
		
		$discard_query = mysqli_query($conn, $discard) or die(mysqli_error($conn));
		mysqli_close($conn);
		
	?>
		</div>
	</div>
</div>
</body>
</html>