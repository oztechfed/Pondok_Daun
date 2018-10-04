<?php
	session_start();
	require_once "files/auth.php";
?>

<!DOCTYPE html5>
<html>
<head>
   <title>Profile</title>
	
	<link rel="stylesheet" type = "text/css" href = "css/menu.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
				<?php if(isset($_SESSION['username'])){
				
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

			} ?>
				<li style="float:right; padding:0;"><a href = "signup.html" style="padding:0;"><img src="images/login.png" style="height:45px; width:60px; float:right; padding:0"></a></li>
				<li><a href="index.php"> Home </a></li>
				<li><a href="menu.php"> Menu </a></li>
				<li><a href="catering.html"> Catering </a></li>
				<li><a href="booking.html"> Booking </a></li>			
			</ul>
			</nav>
			
	</div>
	<div id = "content">
		<div id = "left">
			<div class = "section">
				<h3 style="color:black;"> Profile </h3>
			</div>
		</div>
		<div id = "right">
            <?php 
                require_once "files/config.php";
	
                $conn = mysqli_connect($server, $usrname, $passwd, $dbname);

                $sID = $_SESSION['username'];
			
			    $cust_query = "SELECT * FROM member AS M 
                            WHERE M.name = '".$sID."'";

                $query = mysqli_query($conn, $cust_query) or die(mysqli_error($conn));
			
                while($rows = mysqli_fetch_array($query))
                {
                    $id = $rows['memberID'];
                    $name = $rows['name'];
                    $email = $rows['email'];
                    $address = $rows['address'];
                    $contact = $rows['contact'];
                }
                
                $order_query = "SELECT `order`.`orderDate`, M.name, `order`.`orderType`, `order`.`orderDetails`, `order`.`orderTotal`
                                FROM member AS M, `order`
                                WHERE `order`.`customerID` = M.memberID
                                AND M.memberID = ".$id."
								ORDER BY `orderDate` DESC
								LIMIT 1";

                $query = mysqli_query($conn, $order_query) or die(mysqli_error($conn));

            ?>

            <div id = "profile" style="background-color:white; color:black; width:90%; margin-right:auto; margin-left:auto; padding:5%">
				<form class = "forms">
					<h2 style="text-align:center"><i>Hi <?php echo $name ?></i></h2>
					<h3>User Name (email) : <?php echo $email ?></h3>
					<h3>Address : <?php echo $address ?></h3>
					<p><h3>Contact Number : <?php echo $contact ?></h3></p><br />
					<p><h3>Previous Orders : </h3></p>
					
					<table class="tables">
					<tr>
						<td width='15%'>Date</td>
						<td width='15%'>Customer</td>
						<td width='10%'>Order Type</td>
						<td width='50%'>Description</td>
						<td width='10%'>Total ($)</td>
					</tr>
					</table>
				
					<?php
					while($rows = mysqli_fetch_array($query))
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
				?>
					
				
				<form>
			</div>
		</div>
	</div>
</div>
</body>
</html>