<?php session_start();
if(!isset($_SESSION['uname']) || !isset($_SESSION['umail'])){
	
	header("location:login.php");
	exit;
	}
?>

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
	
	if(isset($_REQUEST['submit'])){ // Fetching variables of the form which travels in URL
	$retail = $_REQUEST['shop'];
	$retailer = $_REQUEST['retailer'];
	$itype = $_REQUEST['item_type'];
	$iname = $_REQUEST['item_name'];
	$iqty = $_REQUEST['qty'];
	$amt = $_REQUEST['amt'];
	$date = $_REQUEST['date'];
	
	
	$sql1 = "INSERT INTO transaction (t_id, shop, vendor, itype, iname, t_qty, amt, date) VALUES(NULL,'$retail','$retailer','$itype','$iname','$iqty','$amt','$date');";
	
	
	if (mysqli_query($conn, $sql1)) {
		
		$sqlupdate = "SELECT iqty FROM inventory where iname='$iname';";
		$res=mysqli_query($conn, $sqlupdate);
		if(mysqli_num_rows($res)>0)
		{
			$sql2 = "UPDATE inventory set iqty= iqty + $iqty ;";
		}else{
		    $sql2 = "INSERT INTO inventory (item_no, icategory, iname, iqty) VALUES(NULL,'$itype','$iname','$iqty');";	
		}
		
		if (mysqli_query($conn, $sql2)) {
		header("location:transaction.php");
		}
		
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>IMS request</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" type="text/css">
 
</head>
<body>

<form>
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
		<fieldset class="req">
		<h2>TRANSACTION</h2>
		<br><br><label>Retail name :</label>
		<input type=text name="shop" class="form-control" required />
		<label style="margin-left:5px"> Vendor name:</label><input style="margin-left:3px" type=text name="retailer" class="form-control" required />
		
		<br><br><br>
		<label>Item type:</label>
		<select name= "item_type"style="margin-left:5px"> 
			<option value="">--Please choose an option--</option>
			<option value="Electronic devices">Electronic devices</option>
			<option value="Stationary">Stationary</option>
			<option value="Networking equipment">Networking equipment</option>
			<option value="Furniture">Furniture</option>
		</select>
		<label style="margin-left:10px"> Item name:</label>
		<input style="margin-left:14px" type=text name="item_name" class="form-control" required />
		<br><br><br>
		<label style="margin-left:2px">Quantity:</label><input  style="margin-left:20px" style="margin-left:10px" type=text name="qty" class="form-control" required />
		<label style="margin-left:13px">Amount:</label><input  style="margin-left:20px" style="margin-left:10px" type=text name="amt" class="form-control" required /><br><br><br>
		<label style="margin-left:2px">Date:</label><input  style="margin-left:42px" style="margin-left:10px" type=date name="date" class="form-control" required /><br><br>
		
		<input type=submit name="submit" value="Submit" class="btn btn-info" />
		<input type=reset name="reset" onClick="location.href='transaction.php'" value="Reset" class="btn btn-info" />
		</fieldset>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="footer">
        
    </div>
    </form>
</body>
</html>