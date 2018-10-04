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
    <title>Edit Menu</title>
    <link rel="stylesheet" type="text/css" href="../css/adminHome.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div id="wrapper">
	<div id="logout">
		<a href="../logout.php"><button id="btn" style="padding:10px; font-size:14px;">Log Out</button></a>
	</div>
    <div id="admin">
	<h1><i>Edit Menu</i></h1>
	</div>
	<div id="nav">
		<br /><br /><br />
        <div class="options" id="editMenu">
            <a href="foodMenu.php"> Food Menu </a>
        </div>
		<div class="options" id="monthlyReport">
            <a href="drinksMenu.php"> Drinks Menu </a>
        </div>
        <div class="options" id="betweenDatesReport">
            <a href="specialMenu.php"> Special Menu </a>
        </div>
		<div class="options" id="adminHome">
            <a href="adminHome.php"> Back Home </a>
        </div>
    </div>
	</div>
</body>
</html>