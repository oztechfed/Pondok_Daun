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
    <title>Sales Report</title>
    <link rel="stylesheet" type="text/css" href="../css/adminHome.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div id="wrapper">
	<div id="logout">
		<a href="../logout.php"><button id="btn" style="padding:10px; font-size:14px;">Log Out</button></a>
	</div>
    <div id="admin">
	<h1><i>Sales Report</i></h1>
	</div>
	<div id="nav">
		<br /><br /><br />
        <div class="options" id="editMenu">
            <a href="dailyReport.php"> Daily Report </a>
        </div>
		<div class="options" id="monthlyReport">
            <a href="monthlyReport.php"> Monthly Report </a>
        </div>
        <div class="options" id="betweenDatesReport">
            <a href="weeklyReport.php"> Specific Dates </a>
        </div>
		<div class="options" id="adminHome">
            <a href="adminHome.php"> Back Home </a>
        </div>
    </div>
	</div>
</body>
</html>