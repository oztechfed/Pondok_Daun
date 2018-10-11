<?php
	session_start();
	require_once "files/auth.php";
?>

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
				<p align="center"><form method="POST">
				<button id="btn" class="dropbtn">Order Type: </button>
					<select name="order_type" style="border: 2px solid black; padding:2%; font-size:16px;">
						<option value="TA">Take Away</option>
						<option value="DL">Delivery</option>
					</select>
					<input type="submit" id="btn" class="dropbtn" name="orderbtn" value="Submit" style="border: 2px solid black" />
				</form></p>
			</div>
		<?php
		require_once "files/config.php";
	
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		
		if(isset($_SESSION['username']))
		{
			$sID = $_SESSION['username'];
			
			$cust_query = 	"SELECT M.memberID, M.name
							FROM member AS M 
							WHERE M.name = '".$sID."'";
			
							
			$query = mysqli_query($conn, $cust_query) or die(mysqli_error($conn));
			
			while($rows = mysqli_fetch_array($query))
			{
				$custID = $rows['memberID'];
			}
		}
		else
		{
			$sID = $_COOKIE["PHPSESSID"];
			$custID = 'NULL';
		}
		
		echo $custID;
		
		date_default_timezone_set('Australia/Adelaide');
		$date = date('y-m-d');
		$today = $date;
		
		if(isset($_POST['orderbtn']))
		{
			$select = "SELECT MI.item_name AS `itemName`, MI.item_price AS `itemPrice`, SC.qnty, SC.cartID
			FROM menu_items AS MI, shoppingcart AS SC, menu_categories AS MC
			WHERE SC.itemID = MI.item_id
			AND SC.catID = MC.id;";
		
			$get_select_result = mysqli_query($conn, $select) or die(mysqli_error($conn));
		
			$order_details = "";
			$order_total = 0;
		
			while($rows = mysqli_fetch_array($get_select_result))
			{
				$cartID = $rows['cartID'];
				$item_name = $rows['itemName'];
				$item_price = $rows['itemPrice'];
				$item_qnty = $rows['qnty'];
			
				$order_details = $order_details . $item_qnty . " x " . $item_name ." || ";
				$order_total = $order_total + ($item_price * $item_qnty);
			}
		
			$select_drinks = "	SELECT DI.drink_name, DI.drink_price, SC.qnty, SC.cartID
						FROM drink_items AS DI, shoppingcart AS SC, menu_categories AS MC
						WHERE SC.itemID = DI.drink_id 
						AND SC.catID = MC.id";
		
			$get_drink_result = mysqli_query($conn, $select_drinks) or die(mysqli_error($conn));
		
			while($rows = mysqli_fetch_array($get_drink_result))
			{
				$drink_name = $rows['drink_name'];
				$drink_price = $rows['drink_price'];
				$drink_qnty = $rows['qnty'];
			
				$order_details = $order_details . $drink_qnty . " x " . $drink_name ." || ";
				$order_total = $order_total + ($drink_price * $drink_qnty);
			}
	
			$order_type = $_POST['order_type'];
			
			if($custID !== 'NULL'){
				$insert = "INSERT INTO `order` (`orderID`, `customerID`, `orderDetails`, `orderType`, `orderTotal`, `orderDate`)
				VALUES ('NULL', '".$custID."', '".$order_details."', '".$order_type."', '".$order_total."', '".$today."')";
			}
			else{
				$insert = "INSERT INTO `order` (`orderID`, `customerID`, `orderDetails`, `orderType`, `orderTotal`, `orderDate`)
				VALUES ('NULL', '3', '".$order_details."', '".$order_type."', '".$order_total."', '".$today."')";
			}
			
		
			$insert_complete = mysqli_query($conn, $insert) or die(mysqli_error($conn));
		
			$delete_query = "DELETE FROM `shoppingcart` WHERE sessionID = '".$sID."'";
			$delete_result = mysqli_query($conn, $delete_query) or die(mysqli_error($conn));
		
			echo "<div style='background-color:white; height:30%'><p align='center' style='font-size:24px; color:black; padding-top:10%'>Thank you!<br /> Your order has been placed. <br /> Back to <a href='index.php' style='text-decoration:none;'>Home</a> page</p></div>";
			mysqli_close($conn);
		}
		
	?>
		</div>
	</div>
</div>
</body>
</html>