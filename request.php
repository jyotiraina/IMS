

<?php 
session_start();
if(!isset($_SESSION['uname']) || !isset($_SESSION['umail'])){
	
	header("location:login.php");
	exit;
	}?>
	
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
	
	if(isset($_REQUEST['request'])){ // Fetching variables of the form which travels in URL
	$itype = $_REQUEST['item_type'];
	$iname = $_REQUEST['item_name'];
	$urge = $_REQUEST['urgency'];
	$qty = $_REQUEST['qty'];
	$req_type = $_REQUEST['req_type'];
	$rdate = $_REQUEST['rdate'];
	$umail = $_SESSION['umail'];

	$sql = "INSERT INTO request (req_no, umail, category, item_name, qty, urgency, req_type, ret_date, date) VALUES(NULL,'$umail','$itype','$iname','$qty','$urge','$req_type','$rdate',now());";	
	if (mysqli_query($conn, $sql)) {
		header("location:summary.php");
		
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
  <script src="jquery-1.11.0.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 
</head>
<body>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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
		<fieldset class="req">
		<h2>REQUEST</h2>
		<br><br><label>Item type:</label>
		<select name= "item_type"style="margin-left:5px"> 
			<option value="">--Please choose an option--</option>
			<option value="Electronic devices">Electronic devices</option>
			<option value="Stationary">Stationary</option>
			<option value="Networking equipments">Networking equipment</option>
			<option value="Furniture">Furniture</option>
		</select>
		<label style="margin-left:5px"> Item name:</label><input type=text name="item_name" class="form-control" required />
		
		<br><br><br>
		
		<label>Urgency:</label>
		<select name= "urgency" style="margin-left:10px"> 
			<option value="">--Please choose an option--</option>
			<option value="Immediate">Immediate</option>
			<option value="In a week">In a week</option>
		</select>  <label style="margin-left:10px">Quantity:</label><input  style="margin-left:10px" type=text name="qty" class="form-control" required /><br><br><br>
		<label>Request Type:</label>
		
		
		<input type="radio" name="req_type" value="Temporary">Temporary    
		
		
		
		<input type="radio" name="req_type" value="Permanent" required style="margin-left:10px" />Permanent<br><br>
		<div id="textboxes" style="display: none; margin-left:-100px"> <label style="margin-left:100px">Date</label><input type=date name="rdate" style="margin-left:30px"/> 
		</div>
		<br><br>
          
        
		<input type=submit name="request" value="Request" class="btn btn-info"  />
		<input  type=button name="reset" onClick="location.href='request.php'" value="Reset" class="btn btn-info" />
		</fieldset>
        </div>

    </div>
    </form>
	
	<script>
$(function() {
    $('input[name="req_type"]').on('click', function() {
        if ($(this).val() == 'Temporary') {
            $('#textboxes').show();
        }
        else {
            $('#textboxes').hide();
        }
    });
});

</script>
  

  

</body>
</html>