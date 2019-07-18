<?php session_start();
if(!isset($_SESSION['uname']) || !isset($_SESSION['umail'])){
	
	header("location:login.php");
	exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>IMS Inventory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" type="text/css">
 
</head>
<body>

<form >
    <div class="page">
        <div class="header">
            <div class="title">
                <h1>
                  Inventory Management System	
                </h1>
            </div>
            <div class="loginDisplay">
                Welcome <span class="bold"> <?php echo $_SESSION['uname']; ?> </span><br>
                        [ <a href="logout.php" ID="HeadLoginStatus" style="text-decoration:none" >Log out </a>]              
			</div>
			<?php include 'navbar.php';?>
		
		</div>
        <div class="main">
		<h2>INVENTORY</h2>
		
		
		<?php 
	$servername = "localhost";
	$database = "ims";
	$username = "root";
	$password = "";

		// Create connection

	$conn = mysqli_connect($servername, $username, $password, $database);

		// Check connection

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
echo'<h3>Stationary</h3>
<table>';
	$query = "SELECT * FROM inventory where icategory='Stationary';";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)==0)
		echo'<td><center>---</center></td>';
	else{
echo'	
		<tr>
		<th>Item Name</th>
		<th>Quantity</th>
		</tr>';

	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)) {

			
echo '  
		<tr>
		<td>'.$row['iname'].'</td>
		<td>'.$row['iqty'].'</td>  
		</tr>';
	}
	}}
	echo'</table>';
	
	echo'<h3>Furniture</h3> <table>';
	$query = "SELECT * FROM inventory where icategory='Furniture';";
	$result = mysqli_query($conn,$query);
	
	if(mysqli_num_rows($result)==0)
		echo'<td><center>---</center></td>';
	else{

echo'	
		<tr>
		<th>Item Name</th>
		<th>Quantity</th>
		</tr>';

	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)) {

			
echo '  
		<tr>
		<td>'.$row['iname'].'</td>
		<td>'.$row['iqty'].'</td>  
		</tr>';
	}}}
	echo'</table>';
	
	echo'<h3>Electronic devices</h3><table>';
	$query = "SELECT * FROM inventory where icategory='Electronic devices';";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)==0)
		echo'<td><center>---</center></td>';
	else{
echo'	
		<tr>
		<th>Item Name</th>
		<th>Quantity</th>
		</tr>';

	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)) {

			
echo '  
		<tr>
		<td>'.$row['iname'].'</td>
		<td>'.$row['iqty'].'</td>  
		</tr>';
	}}}
	echo'</table>';
	
	echo'<h3>Networking equipment</h3><table>';
	$query = "SELECT * FROM inventory where icategory='Networking equipment';";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)==0)
		echo'<td><center>---</center></td>';
	else{
echo'	
		<tr>
		<th>Item Name</th>
		<th>Quantity</th>
		</tr>';

	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)) {

			
echo '  
		<tr>
		<td>'.$row['iname'].'</td>
		<td>'.$row['iqty'].'</td>  
		</tr>';
	}}}
echo'</table>';
  
  mysqli_close($conn);
?>
		
</div>
 </div>
</body>
</html>