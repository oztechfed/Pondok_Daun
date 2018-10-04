<?php
	session_start();
	require_once "files/auth.php";
?>

<!DOCTYPE html5>
<html>
<head>
	<title>Menu</title>
	
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
		
		$get_categories = "SELECT * FROM menu_categories AS MC WHERE MC.id BETWEEN 1 AND 9 ORDER BY id";
		
		$get_categories_result = mysqli_query($conn, $get_categories) or die(mysqli_error($conn));
		$flag = true;
		while($rows = mysqli_fetch_array($get_categories_result))
		{
			$category_id = $rows['id'];
			$category_name = $rows['category_name'];
			
			$get_items_sql = "SELECT * FROM menu_items as MI 
							WHERE MI.id = ".$category_id."";
							
						
			/*Display the categories for the menu*/
			echo "<div id = 'menu'>";
			echo "<p align='center'><button id='btn' onclick='myFunction(".$category_id.")' class='dropbtn'>".$category_name."</button></p><br/>
				<div id=".$category_id." class='dropdown-content' style='display:none; width:90%;'>";
				
			$get_items_result = mysqli_query($conn, $get_items_sql) or die(mysqli_error($conn));
			
					while($items = mysqli_fetch_array($get_items_result))
					{
						$item_id = $items['item_id'];
						$item_name = $items['item_name'];
						$item_price = $items['item_price'];
						
						/*Display the inside content - menu items*/
						echo"
							<form method='POST' style='margin-bottom:0.2px;margin-top:0.2px;'>
							<table class='tables'>
							<tr>
								<td width='75%'>". $item_name ."</td>
								<td width='15%'>$". $item_price ."</td>
								<td width='10%'><input type='number' name='qnty' min='1' style='width: 30px;' value='1' /><input type='submit' name='add' value='+' onclick='added()' /></td>
								<input type='hidden' name='cat_id' value='".$category_id."'/>
								<input type='hidden' name='item_id' value='".$item_id."'/>
							</tr>
							</table>
							</form>";
					};
					
					if ( isset( $_POST['add'] ) && $flag )
					{
						$flag = false;
						
						$qnty = $_POST['qnty'];
						$cat_id = $_POST['cat_id'];
						$itm_id = $_POST['item_id'];
						$order_query = "INSERT INTO `shoppingcart`(`catID`, `sessionID`, `itemID`,`qnty`)
						VALUES(".$cat_id.", '".$sID."', ".$itm_id.",".$qnty.")";
						
						$place_order = mysqli_query($conn, $order_query) or die(mysqli_error($conn));
						
						print($order_query);
					}
			echo "</div>";
			echo "</div>";
		}
		mysqli_free_result($get_categories_result);
		mysqli_close($conn);
	?>
		</div>
	</div>
</div>
</body>
</html>