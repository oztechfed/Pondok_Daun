<?php
session_start();
require_once "files/auth.php";
?>
<?php
	//if($_SERVER['REQUEST_METHOD'] == 'POST') 
	//{
		// Call logout() from auth.php
		logout();
		echo $_SESSION['username'];
	//}
	header('Location: index.php');
?>