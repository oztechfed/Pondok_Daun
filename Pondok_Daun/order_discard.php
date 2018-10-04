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
				<li><a href="menu.php"> Menu </a></li>
				<li><a href="catering.html"> Catering </a></li>
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
		
		if(isset($_SESSION['username']))
		{
			$sID = $_SESSION['username'];
		}
		else
		{
			$sID = $_COOKIE["PHPSESSID"];
		}
		
		$discard = "DELETE FROM `shoppingcart` WHERE sessionID = '".$sID."'";
		
		$discard_query = mysqli_query($conn, $discard) or die(mysqli_error($conn));
		mysqli_close($conn);
		
	?>
		</div>
	</div>
</div>
</body>
</html>