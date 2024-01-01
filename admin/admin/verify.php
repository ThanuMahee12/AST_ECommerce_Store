<?php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/log.css">
  <script src="js/sweetalert.min.js"></script>
  <title>Admin - Verify Account</title>
</head>
<body>


	<div class="login-box">
		<img src="img/avatar2.png" class="avatar">
		<h1>Verify Code</h1>
			<form name="login_form" action="" method="POST">

				<p>Verification Code</p>
				<input type="text" name="code" id="code">

				<input type="submit" value="Submit Code" name="submit_btn">
				<br><br>

			</form>

	</div>

    <?php
   
	if(isset($_POST["submit_btn"]))
	{	
		
		$id = $_GET["id"];

		$res= mysqli_query($link,"select code from admin_login where admin_ID = '$id' ");
		$row=mysqli_fetch_row($res); 
		$code = $row[0];

		$match = strcmp($code, $_POST["code"]);

		if($match == 0 && $_POST["code"] != "")
		{
			?>
        		<script type="text/javascript">
					window.location="pwd_reset.php?id=<?php echo $id; ?>";
        		</script>
        	<?php
        	mysqli_query($link, "update admin_login set code = '' where admin_ID = '$id'");
		}
		else
		{
			?>
        		<script type="text/javascript">
					swal({
    					title: "Verification",
    					text: "Invalid Code. Try Again!!!",
    					icon: "error"
					}).then(function() {
    					window.location = "verify.php?id=<?php echo $id; ?>";
					});
        		</script>
        	<?php
		}

	}
	?>


</body>
</html>