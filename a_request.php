<?php session_start();
if(!isset($_SESSION['uname']) || !isset($_SESSION['umail'])){
	
	header("location:login.php");
	exit;
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> IMS Inventory<3 </title>
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
		<h2>REQUESTS</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><table>
		
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
	
		if(isset($_REQUEST['accept']))
		{
			$r = $_REQUEST['accept'];
			$sql = "UPDATE request set status='Accept' WHERE req_no='$r' ;" ;
            if(mysqli_query($conn,$sql)){
			$sql1 = "SELECT * from request WHERE req_no='$r' ;";
			$result1=mysqli_query($conn,$sql1);
			$i=mysqli_fetch_assoc($result1);
			if($i){
			$qty=$i['qty'];
			$iname=$i['item_name'];
			
			$sql="UPDATE inventory set iqty = iqty-'$qty' where iname = '$iname'  ;" ;
			if(mysqli_query($conn,$sql))
			{
			header("location:a_request.php");	
			}
			}
			}
		}
	
		if(isset($_REQUEST['decline'])){			// Fetching variables of the form which travels in URL
		$r = $_REQUEST['decline'];
		$sql = "UPDATE request set status='Decline' WHERE req_no='$r' ;";
		if(mysqli_query($conn,$query)){
			header("location:a_request.php");
		}
		}

	
	$query = "SELECT * FROM request WHERE status is null ;";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)==0)
		echo'<td><center>NO NEW REQUESTS AVAILABLE</center></td>';
	else{
		
	echo'<tr>
	<th>User Mail</th>
    <th>Item Name</th>
    <th>Quantity</th>
    <th>Urgency</th>
	<th>Req Type</th>
	<th colspan="2"><center>Request</center></th>';		
	if(mysqli_num_rows($result)!=0){
	
		while($row = mysqli_fetch_assoc($result)) {
echo '
  <tr>
	<td>'.$row['umail'].'</td>
	<td>'.$row['item_name'].'</td>
    <td>'.$row['qty'].'</td>
    <td>'.$row['urgency'].'</td>
    <td>'.$row['req_type'].'</td>';
	$iname = $row['item_name'];
	$qty=$row['qty'];
	$sq= "SELECT * from inventory WHERE iname='$iname';";
	$res=mysqli_query($conn,$sq);

	if(mysqli_num_rows($res)==0)
	{echo'<td ><label style="margin-left:12px;">Item absent<label></td>';}
 
    else{
		$b= mysqli_fetch_assoc($res);
		$iqty=$b['iqty'];
		if($iqty < $qty)
		{
			echo 'Not Enough';
		}else{
	echo'<td><center>
	<button type=submit class="btn btn-info" name="accept" value="'.$row['req_no'].' ">Accept</button>
	<button type=submit class="btn btn-info" name="decline" value="'.$row['req_no'].' " style="margin:0px 30px;" ">Decline</button></center></td>';
	}}
		echo'</tr>';
	}
	}
	}
  
  mysqli_close($conn);
?>
	
  </table></form>
		
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="footer">
        
    </div>
    </form>
  

  

</body>
</html>