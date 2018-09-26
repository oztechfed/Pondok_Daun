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
	<title>Update Menu</title>
	<link rel="stylesheet" type="text/css" href="../css/adminMulti.css">
	
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
	function up()
	{
		alert("Price Updated");
	}
</script>
<script>	
	function del()
	{
		alert("Item Deleted");
	}
</script>
<script>
	function added()
	{
		alert("Item added to the menu");
	}
</script>

</head>
<body>
<div id = "wrapper">
	<div id='nav'>
		<nav>
			<ul>
				<li> <a href="adminHome.php"> Admin Home </a></li>
				<li><a href="editMenu.php"> Menu </a></li>
				<li><a href="viewBookings.php"> Bookings </a></li>
				<li><a href="viewCatering.php"> Catering enquires </a></li>	
				<li><a href="salesReport.php"> Sales Report </a></li>
				<li><a href="viewOrders.php"> View Orders </a></li>
				<li><a href="../index.php"> View Website </a></li>
				<li><a href="editMenu.html"> Edit Website </a></li>			
			</ul>
		</nav>
		</div>
	<div id = "content">
		<div id = "right">
		<?php
	
		$conn = mysqli_connect($server, $usrname, $passwd, $dbname);
		
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
			echo "<div id = 'menu' style='padding-top:20px;'>";
			echo "<p align='center'><button id='btn' onclick='myFunction(".$category_id.")' class='dropbtn'>".$category_name."</button></p><br/>
				<div id=".$category_id." class='dropdown-content' style='display:none; width:90%;'>";
				
			$get_items_result = mysqli_query($conn, $get_items_sql) or die(mysqli_error($conn));
			
					while($items = mysqli_fetch_array($get_items_result))
					{
						$cat_id = $items['id'];
						$item_id = $items['item_id'];
						$item_name = $items['item_name'];
						$item_price = $items['item_price'];
						
						/*Display the inside content - menu items*/
						echo"
							<form method='POST' style='margin-bottom:0.2px;margin-top:0.2px;'>
							<table class='tables'>
							<tr>
								<td width='65%'>". $item_name ."</td>
								
								<td width='15%'><input type='text' style='width:90%; color:black; font-size:18px; text-align:center' placeholder='$". $item_price ."' name='UPrice' /></td>
								
								<td width='10%'><input type='submit' name='update' value='Update' onclick='up()' /></td>
								<td width='10%'><input type='submit' name='delete' value='Delete' onclick='del()' /></td>
								<input type='hidden' name='item_id' value='".$item_id."'/>
							</tr>
							</table>
							</form>";
					};
					
					echo "<form method='POST' style='margin-bottom:0.2px;margin-top:0.2px;'>
							<table class='tables'>
							<tr>
								<td width='65%'><input type='textarea' style='width:90%; color:black; font-size:18px; text-align:center' name='Nname' placeholder='Add New Item Name' /></td>
								<td width='15%'>$ <input type='number' min='1' step='any' style='width:60%; color:black; font-size:18px; text-align:center' name='Nprice' placeholder='Price'/></td>
								<input type='hidden' name='cat_id' value='".$cat_id."'/>
								<td width='20%'><input type='submit' name='add' value='Add Item' onclick='added()' /></td>
							</tr>
							</table>
							</form>";
							
					if ( isset( $_POST['delete'] ) && $flag )
					{
						$flag = false;

						$itm_id = $_POST['item_id'];
						
						$delete_query = "DELETE FROM `menu_items` 
										WHERE `item_id` = '".$itm_id."'";
						
						$delete = mysqli_query($conn, $delete_query) or die(mysqli_error($conn));
					}
					
					if ( isset( $_POST['add'] ) && $flag )
					{
						$flag = false;
						
						$id = $_POST['cat_id'];
						$name = $_POST['Nname'];
						$price = $_POST['Nprice'];
						
						$insert_query = "INSERT INTO `menu_items`(`id`, `item_id`, `item_name`, `item_price`) 
										VALUES ('".$id."', 'NULL', '".$name."', '".$price."')";
						
						$insert = mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
					}
					
					if ( isset( $_POST['update'] ) && $flag )
					{
						$flag = false;
						
						$id = $_POST['item_id'];
						$new_price = $_POST['UPrice'];
						
						$update_query = "UPDATE `menu_items` SET `item_price`= '".$new_price."' 
										WHERE `menu_items`.`item_id` = ".$id." ";
						
						$update = mysqli_query($conn, $update_query) or die(mysqli_error($conn));
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