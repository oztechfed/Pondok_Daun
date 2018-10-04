<?php
	session_start();
	require_once "files/auth.php";
?>

<!DOCTYPE html5>
<html>
<head>
	<title>Drinks Menu</title>
	
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
		
		$get_categories = "SELECT * FROM menu_categories AS MC WHERE MC.id BETWEEN 10 AND 14 ORDER BY id";
		
		$get_categories_result = mysqli_query($conn, $get_categories) or die(mysqli_error($conn));
		$flag = true;
		while($rows = mysqli_fetch_array($get_categories_result))
		{
			$category_id = $rows['id'];
			$category_name = $rows['category_name'];
			
			$get_drinks_sql = "SELECT * FROM drink_items as DI 
							WHERE DI.id = ".$category_id."";
							
						
			/*Display the categories for the menu*/
			echo "<div id = 'menu'>";
			echo "<p align='center'><button id='btn' onclick='myFunction(".$category_id.")' class='dropbtn'>".$category_name."</button></p><br/>
				<div id=".$category_id." class='dropdown-content' style='display:none; width:90%;'>";
				
			$get_drinks_result = mysqli_query($conn, $get_drinks_sql) or die(mysqli_error($conn));
					while($drinks = mysqli_fetch_array($get_drinks_result))
					{
						$drink_id = $drinks['drink_id'];
						$drink_name = $drinks['drink_name'];
						$drink_price = $drinks['drink_price'];
						
						/*Display the inside content - menu items*/
						echo"
							<form method='POST' style='margin-bottom:0.2px;margin-top:0.2px;'>
							<table class='tables'>
							<tr>
								<td width='75%'>". $drink_name ."</td>
								<td width='15%'>$". $drink_price ."</td>
								<td width='10%'><input type='number' name='qnty' min='1' style='width: 30px;' value='1' /><input type='submit' name='add' value='+' onclick='added()' /></td>
								<input type='hidden' name='cat_id' value='".$category_id."'/>
								<input type='hidden' name='drink_id' value='".$drink_id."'/>
							</tr>
							</table>
							</form>";
					};
					
					if ( isset( $_POST['add'] ) && $flag )
					{
						$flag = false;
						
						$qnty = $_POST['qnty'];
						$cat_id = $_POST['cat_id'];
						$drnk_id = $_POST['drink_id'];
						
						$order_query = "INSERT INTO `shoppingcart`(`catID`, `sessionID`, `itemID`, `qnty`)
						VALUES(".$cat_id.", '".$sID."', ".$drnk_id.",".$qnty.")";
						
						$place_order = mysqli_query($conn, $order_query) or die(mysqli_error($conn));
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