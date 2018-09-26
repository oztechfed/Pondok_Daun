<?php
	session_start();
	require_once "../files/config.php";
	require_once "../files/auth.php";
	require_login();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="../css/adminHome.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div id="wrapper">
	<div id="logout">
		<a href="../logout.php"><button id="btn" style="padding:10px; font-size:14px;">Log Out</button></a>
	</div>
    <div id="admin">
	<br />
	<h1><i>Admin Page</i></h1>
	</div>
	<div id="nav">
        
        <div class="options" id="editMenu">
            <a href="editMenu.php"> Edit Menu </a>
        </div>
        <div class="options" id="viewBooking">
            <a href="viewBookings.php"> View Bookings </a>
        </div>
        <div class="options" id="viewCatering">
            <a href="viewCatering.php"> View Catering enquires </a>
        </div>
        <div class="options" id="salesReport">
            <a href="salesReport.php"> View Sales Report </a>
        </div>
        <div class="options" id="viewOrders">
            <a href="viewOrders.php"> View Orders </a>
        </div>
		<div class="options" id="View Website">
            <a href="../index.php"> View Website </a>
        </div>
		<div class="options" id="View Website">
            <a href="editWebsite.php"> Edit Website Description </a>
        </div>
    </div>
	</div>
</body>
</html>