<?php
	session_start();
	require_once "files/auth.php";
?>

<!DOCTYPE html5>
<html>
<head>
	<title>Order Cart</title>
	
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

<script>
	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
	function toggle() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) 
	{
	if (!event.target.matches('.accdropbtn')) {

		var dropdowns = document.getElementsByClassName("accdropdown-content");
		var i;
		for (i = 0; i < accdropdowns.length; i++) {
		var openDropdown = accdropdowns[i];
		if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
			}
		}
	}
	}
</script>

<style>
.accdropbtn {
    background-color: #98FB98;
    color: black;
    padding: 14px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.accdropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

.accdropdown {
    position: relative;
    display: inline-block;
}

.accdropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.accdropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.accdropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>
<body>
<div id = "wrapper">
	<div id = "nav">
			<nav>
			<ul>
				<?php if(isset($_SESSION['username']))
				{
				
				echo "<div class='accdropdown' style='float:right; text-decoration:none; margin-right:10px;'>
						<button onclick='toggle()' class='accdropbtn'>" . $_SESSION['username']. "</button>
						<div id='myDropdown' class='accdropdown-content'>";
							if($_SESSION['username'] === "admin")
							{
								echo "<a href='admin/adminHome.php'>Admin Page</a>";
							}
							echo "<a href='details.php'>View Profile</a>
								<a href='logout.php'>Log Out</a>
						</div>
					</div>";
				}
				?>
				<li style="float:right; padding:0;"><a href = "signup.html" style="padding:0;"><img src="images/login.png" style="height:45px; width:60px; float:right; padding:0"></a></li>
				<li><a href="index.php"> Home </a></li>
				<li><a href="catering.html"> Catering </a></li>
				<li><a href="booking.html"> Booking </a></li>	
				<li><a href="order_cart.php"> Cart </a></li>			
			</ul>
			</nav>
			
	</div>
	<div id = "content">
		<div id = "left">
			<div class = "section">
				<h3><a href="menu.php" style="color:black;"> Food </a></h3>
			</div>
			<div class = "section">
				<h3> Special </h3>
			</div>
			<div class = "section">
				<h3><a href="menu_drink.php" style="color:black;"> Drinks </a></h3>
			</div>
		</div>
		<div id = "right">
		<?php
		require_once "files/config.php";
	
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		
		if(isset($_SESSION['username']))
		{
			$sID = $_SESSION['username'];
		}
		else
		{
			$sID = $_COOKIE["PHPSESSID"];
		}
		
		$get_food = "SELECT MI.item_name , MI.item_price, SC.qnty, SC.cartID
					FROM menu_items AS MI, shoppingcart AS SC, menu_categories AS MC
					WHERE SC.itemID = MI.item_id
					AND SC.catID = MC.id
					AND SC.sessionID = '".$sID."'";
		
		$get_food_result = mysqli_query($conn, $get_food) or die(mysqli_error($conn));
		$total = 0;
		
		echo "<p align='center'><button id='btn' class='dropbtn'>Your Cart</button></p>";
		echo "<p align='center'><button id='btn' class='dropbtn'>Food</button></p><br/>";
				
		while($rows = mysqli_fetch_array($get_food_result))
		{
			$item_name = $rows['item_name'];
			$item_price = $rows['item_price'];
			$item_qnty = $rows['qnty'];
			$cart = $rows['cartID'];
			
			$total = $total + ($item_price * $item_qnty);
			
			echo 
			"<div id='cart' style='width:90%; margin-left:auto; margin-right:auto'>";
				echo"<table class='tables' style='background-color:white;'>
					<tr>
						<td width='85%'>".$item_qnty."  x  ".$item_name."</td>
						<td width='15%'>$".($item_price * $item_qnty)."</td>
					</tr>
				</table>";
			echo "</div>";		
		};
		
		$get_drinks = "	SELECT DI.drink_name, DI.drink_price, SC.qnty, SC.cartID
						FROM drink_items AS DI, shoppingcart AS SC, menu_categories AS MC
						WHERE SC.itemID = DI.drink_id 
						AND SC.catID = MC.id
						AND SC.sessionID = '".$sID."'";
		
		$get_drink_result = mysqli_query($conn, $get_drinks) or die(mysqli_error($conn));
		
		echo "<p align='center'><button id='btn' class='dropbtn'>Drinks</button></p><br/>";
		while($rows = mysqli_fetch_array($get_drink_result))
		{
			$drink_name = $rows['drink_name'];
			$drink_price = $rows['drink_price'];
			$drink_qnty = $rows['qnty'];
			$cart = $rows['cartID'];
			
			$total = $total + ($drink_price * $drink_qnty);
			
			echo 
			"<div id='cart' style='width:90%; margin-left:auto; margin-right:auto'>";
				echo"<table class='tables' style='background-color:white;'>
					<tr>
						<tr>
						<td width='85%'>".$drink_qnty."  x  ".$drink_name."</td>
						<td width='15%'>$".($drink_price * $drink_qnty)."</td>
					</tr>
				</table>";
			echo "</div>";		
		};
		
		echo 
			"<div id='cart' style='width:90%; margin-left:auto; margin-right:auto'>";
		echo"<table class='tables' style='background-color:white;'>
					<tr>
						<tr>
						<td width='85%'></td>
						<td width='15%'></td>
					</tr>
					<tr>
						<tr>
						<td width='85%'>Total</td>
						<td width='15%'>$".$total."</td>
					</tr>
				</table>";
			echo "</div>";
			
			echo "<p align='center'><a href='order_discard.php'><input type='submit' id='btn' class='dropbtn' value='Discard Order' /></a></p><br/>";
			echo "<p align='center'><a href='order_confirmed.php'><input type='submit' id='btn' class='dropbtn' value='Place Order' /></a></p><br/>";
			
		/*mysqli_free_result($get_categories_result);*/
		mysqli_close($conn);
	?>
		</div>
	</div>
</div>
</body>
</html>