<?php
	session_start();
	require_once "files/config.php";
	require_once "files/auth.php";
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pondok Duan</title>
	
	<link rel="stylesheet" type = "text/css" href = "css/main.css">
	
	<!--Script to check day-->
	<script>	
		function whatsTheDay() 
		{
			var inDat = document.getElementById('dateInput').value;
			var inDate = new Date(inDat)
			while(inDate.getDay() == 0)
			{ 	// 0 = sunday , 1 = monday ..etc
				//alert('sunday');
				// do any thing
				document.getElementById('submit').disabled = true;
				document.getElementById('submit').value = 'Book Now';
				document.getElementById('err').innerHTML ='Restaurant is closed on Sunday'
			}
			else
			{
				//alert('not sunday');
				document.getElementById('submit').value = 'Book Now';
				document.getElementById('submit').disabled = false;
			}
		}

		function sumitable()
		{
			var inDate = document.getElementById('dateInput').valueAsDate;
			if(inDate.getDay() != 0)
			{
				document.forms["myform"].submit();
			}
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
	<div id="wrapper">
		<div id="top">
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
			<a href = "signup.html"><img src="images/login.png"></a>
		</div>
		<div id="banner">
			<img src="images/Main_Banner.JPG">
		</div>
		<div class = "line">
		</div>
		<div id="navigation">
			<nav>
				<ul>
				<li><a href="menu.php">Menu</a></li>
				<li><a href="booking.html">Book Now</a></li>
				<li style="margin-right:0;"><a href="catering.html">Catering</a></li>
				</ul>
			</nav>
		</div>
		<div class = "line">
		</div>
		<div id="center">
			<div id="bt">
			<p style="margin:0; padding:20px; text-align:center; font-weight:300;">Pondok Daun is a family owned authentic Indonesian Restaurant right in the heart of <br>Adelaide city - A place where the Asian cusine meets the westren world. We believe in serving <br>the finest quality food cooked in tradional manner. Come and experience for yourself and be a part of our family.<br><br><b> Excellent Reviews |  $  | Indonesian, Vegetarian, Vegan, Gluten Free Options, Halal Certified</b>
			</p>
			</div>
			
			<div class = "line">
			</div>
			
			<div id="bc">
				<div id="slideshow">
					<img class="mySlides" src="images/Food1.jpg">
					<img class="mySlides" src="images/Food2.jpg">
					<img class="mySlides" src="images/Food3.jpg">
					<img class="mySlides" src="images/Food4.jpg">
					<img class="mySlides" src="images/Food5.jpg">
					<img class="mySlides" src="images/Food6.jpg">
					<img class="mySlides" src="images/Food7.JPG">
					<img class="mySlides" src="images/Food8.JPG">
					<img class="mySlides" src="images/Food9.jpg">
					<img class="mySlides" src="images/Food10.jpg">
					<img class="mySlides" src="images/Dessert.jpg">
				</div>
				<div id="hrs">
				<h3 style="text-align:center;">Opening Hours</h3>
				<table class="tables">	
					<tr><td>Monday</td><td> - </td><td>	11am to 8.30pm</td></tr>
					<tr><td>Tuesday</td><td> - </td><td> 11am to 8.30pm</td></tr>
					<tr><td>Wednesday</td><td> - </td><td> 11am to 8.30pm</td></tr>
					<tr><td>Thursday</td><td> - </td><td> 11am to 8.30pm</td></tr>
					<tr><td>Friday</td><td> - </td><td> 11am to 8.30pm</td></tr>
					<tr><td>Saturday</td><td> - </td><td> 11am to 8.30pm</td></tr>
					<tr><td>Sunday</td><td> - </td><td> Closed</td></tr>
				</table>
				<br>
				<p style="text-align:center;"><b>Address: 94 Currie Street<br>Adelaide, 5000.</b></p>
				<p style="text-align:center;">A diverse menu to choose from.. <br>Dine and Take Away available.</p>
				</div>
			</div>
			<script>
				var myIndex = 0;
				slideshow();

				function slideshow() {
					var i;
					var x = document.getElementsByClassName("mySlides");
					
					for (i = 0; i < x.length; i++) {
						x[i].style.display = "none";  
					}
					myIndex++;
					if (myIndex > x.length) {myIndex = 1}x[myIndex-1].style.display = "block";  
					setTimeout(slideshow, 3000); // Change image every 2 seconds
				}
			</script>

			<div class = "line" style="width:90%;">
			</div>
			
			<div id="bb">
			<p style="margin:0; padding:20px; text-align:center; font-weight:300;"> A place where the Asian cusine meets the westren world. Pondok Daun is a family owned authentic Indonesian Restaurant right in the heart of <br>Adelaide city - We believe in serving <br>the finest quality food cooked in tradional manner. Come and experience for yourself and be a part of our family.<br><br> Excellent Reviews |  $  | Indonesian, Vegetarian, Vegan, Gluten Free Options, Halal Certified
			</p>
			</div>
		</div>
		<div id="bottom">
		<div id="map"></div>

		<script>
			function myMap() 
			{
				var myCenter = new google.maps.LatLng(-34.924250, 138.596083);
				var mapCanvas = document.getElementById("map");
				var mapOptions = {center: myCenter, zoom: 17};
				var map = new google.maps.Map(mapCanvas, mapOptions);
				var marker = new google.maps.Marker({ position: myCenter, animation: google.maps.Animation.DROP});
				marker.setMap(map);
				
				var infowindow = new google.maps.InfoWindow({content: "94 Currie Street"});
				infowindow.open(map,marker);
			}
		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0jgv74Ad4hz20KgcPOqY_EKJC_nXlLL4&callback=myMap"></script>
		</div>
		<div id="footer">
			<p>Contact Us <br>
			Phone Number: (08) 8212 1449 <br>
			Email: pondokdaunadl@gmail.com</p>
			<a href = "https://www.instagram.com/pondokdaunadl/"><img src="images/instagram.png"></a>
			<a href = "https://www.facebook.com/PondokDaunADL/"><img src="images/facebook.png" style="width:140px;"></a>
		</div>
	</div>
</body>
</html>