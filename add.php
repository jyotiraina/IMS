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
	
	if(isset($_REQUEST['add'])){ // Fetching variables of the form which travels in URL
	$user_name = $_REQUEST['name'];
	$user_email = $_REQUEST['email'];
	$user_password = $_REQUEST['pass'];
	$user_role = $_REQUEST['role'];
	$sql = "INSERT INTO users (uname, umail, upass, urole) VALUES('$user_name','$user_email','$user_password','$user_role');";
	
	if (mysqli_query($conn, $sql)) {
		
		header("location:add.php");
		
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
		<h2>ADD USER</h2>
		<br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<label>Name:</label>
		<input type=text name="name" style="margin-left:24px" required /><br><br><br>
		<label>Email:</label>
		<input type=text name="email" style="margin-left:28px" required /><br><br><br>
		<label>Password:</label>
		<input type=text name="pass" style="margin-left:6px" required /><br><br><br>
		<label>Role name:</label> <select name= "role"> 
			<option value="">--Please choose an option--</option>
			<option value="1">Admin</option>
			<option value="0">Users</option>
		</select><br><br><br>
		<input type=submit name="add" value="Add" class="btn btn-info" />
		<input type=reset name="reset" onClick="location.href='add.php'" value="Reset" class="btn btn-info" />
		<form>
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