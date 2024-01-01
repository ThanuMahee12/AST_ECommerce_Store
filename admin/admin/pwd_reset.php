<?php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
$id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/log.css">
  <script src="js/sweetalert.min.js"></script>
  <title>Admin - Reset Password</title>
</head>
<body>


	<div class="login-box">
		<img src="img/avatar2.png" class="avatar">
		<h1>Reset Password</h1>
			<form name="login_form" action="" method="POST">

				<p>New Password</p>
				<input type="password" name="npwd" id="npwd" >

				<p>Re-Enter Password</p>
				<input type="password" name="repwd" id="repwd" >

				<input type="submit" value="Reset Password" name="submit_btn">
				<br><br>

			</form>

	</div>


<?php
   
	if(isset($_POST["submit_btn"]))
	{	
		$n = strcmp("", $_POST["npwd"]);
		$r = strcmp("", $_POST["repwd"]);
		$c = strcmp($_POST["repwd"], $_POST["npwd"]);

			if( $n == 0 || $r == 0)
			{
				?>
        		<script type="text/javascript">
        			swal({
    					title: "Password Reset",
    					text: "Fields Can't be empty",
    					icon: "warning"
					}).then(function() {
    					window.location = "pwd_reset.php?id=<?php echo $id; ?>";
					});
        		</script>
        		<?php
			}
			else if($c != 0)
			{
				?>
        		<script type="text/javascript">
        			swal({
    					title: "Password Reset",
    					text: "Password not matched. try again",
    					icon: "error"
					}).then(function() {
    					window.location = "pwd_reset.php?id=<?php echo $id; ?>";
					});
        		</script>
        		<?php
			}
			else
			{
				$encrypt_pwd = password_hash($_POST["npwd"], PASSWORD_DEFAULT);

				mysqli_query($link,"update admin_login set password = '$encrypt_pwd' where admin_ID = '$id'");
				?>
        			<script type="text/javascript">
        				swal({
    					title: "Password Reset",
    					text: "Password reset successfully!!!",
    					icon: "success"
					}).then(function() {
    					window.location="admin_login.php";
					});
						
        			</script>
        		<?php
			}
			
			


	}
	?>


</body>
</html>