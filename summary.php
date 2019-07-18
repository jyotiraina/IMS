<?php session_start();
if(!isset($_SESSION['uname']) || !isset($_SESSION['umail'])){
	$mes="Not Valid Session/Authentication";
	echo "<script type='text/javascript'>
	alert('$mes'); </script>";
	header("location:login.php");
	exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>IMS Inventory<3</title>
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
							
			<div class= "menu">
			<a href="request.php">Request</a>
			<a href="summary.php"> Summary </a>
			<a href="dashboard.php"> Home </a>  
			</div>
		
		</div>
        <div class="main">
		<h2>SUMMARY</h2>
		<table>
		
		<tr>
	<th>Date</th>
    <th>Item Type</th>
    <th>Item Name</th>
    <th>Quantity</th>
    <th>Urgency</th>
	<th>Status</th>
	<th>Return Date</th>
    
    </tr>
		
		
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
	$user_email=$_SESSION['umail'];
	$query = "SELECT * FROM request where umail= '$user_email'";
	$result = mysqli_query($conn,$query);
	
	if(mysqli_num_rows($result)!=0){
		while($row = mysqli_fetch_assoc($result)) {
	
	if ($row['status']==NULL){
		$status = "Pending";
	}else{
		$status = $row['status'];
	}
	
	if($row['ret_date']!="0000-00-00"){
		$rdate = $row['ret_date'];
	}else{
		$rdate = 'Permanent Issue';
	}
echo '
  <tr>
	<td>'.$row['date'].'</td>
    <td>'.$row['category'].'</td>
    <td>'.$row['item_name'].'</td>
    <td>'.$row['qty'].'</td>
    <td>'.$row['urgency'].'</td>
	<td>'.$status.'</td>
	<td>'.$rdate.'</td>
    
	</tr>';
	}
	}
  
  mysqli_close($conn);
?>
  
    </form>
</body>
</html>