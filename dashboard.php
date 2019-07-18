<?php session_start();
if(!isset($_SESSION['uname']) || !isset($_SESSION['umail'])){
	
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
			<?php if(isset($_SESSION['urole']) && $_SESSION['urole']!=0){?>
			<a href="inventory.php">Inventory</a>
			<a href="a_request.php">Requests</a>
			<a href="transaction.php">Transactions</a>
			<a href="add.php"> Functions </a>
			<?php }?>
			<?php if(isset($_SESSION['urole']) && $_SESSION['urole']!=1){?>
			<a href="summary.php"> Summary </a>
			<a href="request.php" >Request</a>
			<?php }?>
			<a href="dashboard.php"> Home </a>  
			</div>
		
		</div>
        <div class="main">
		<img src="slide3.png" style="height:395px; width:800px ; margin: 0px 120px;">
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="footer">
        
    </div>
    </form>

</body>
</html>