<?php
    
	$servername = "localhost";
	$database = "ims";
	$username = "root";
	$password = "";
//$_SESSION['VARIABLE_NAME']=
		// Create connection

	$conn = mysqli_connect($servername, $username, $password, $database);

		// Check connection

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	if(isset($_POST['login'])){ // Fetching variables of the form which travels in URL
	$user_email = $_POST['user_name'];
	$user_password = $_POST['user_password'];
	$query = "SELECT * FROM users where users.umail= '$user_email' AND users.upass= '$user_password' ";
	$resultset = mysqli_query($conn,$query);
	
	$row = mysqli_fetch_assoc($resultset);
	if(mysqli_num_rows($resultset)==1){
    session_start();
	$_SESSION['urole']=$row['urole'];
	$_SESSION['uname']=$row['uname'];
	$_SESSION['umail']=$row['umail'];
    $_SESSION['session_id']=1;
	
	
	$sql = "INSERT INTO login (umail, upass, datetime) VALUES('$user_email','$user_password',now());";
	
	if (mysqli_query($conn, $sql)) {
		header("location:dashboard.php");
		
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
	else
	{
		session_destroy();
	}
    

	mysqli_close($conn);

	}
?>
	
<!DOCTYPE html>
<html>
<head>
	
  <title>IMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" type="text/css">
 

</head>
<body>
	
	
    <div class="page">
        <div class="header">
            <div class="title">
			<h1>
                  Inventory Management System	
                </h1>
            </div>
            <div class="loginDisplay">
                     WELCOME
                            </div>
            <div class="clear hideSkiplink">
                            </div>
        </div>
        <div class="main">
		<br><br>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<fieldset class="login">
		<label>Username:</label>
				<input type="text" name="user_name"  required/><br /><br /><br />
				<label>Password:</label>
				<input type="password" name="user_password" required/> <br /><br /><br /><br />
				<input type="submit" name="login" value="Login" class="btn" />
				<input type="button" name="reset"  value="Reset" class="btn" />
        </fieldset>
		<div class="clear">
        </div>
		</form>
    </div>
    <div class="footer">
        
    </div>
</body>
</html>