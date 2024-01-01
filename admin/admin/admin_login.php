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
  <title>Admin - Log In</title>
</head>
<body>


	<div class="login-box">
		<img src="img/avatar2.png" class="avatar">
		<h1>Login Here</h1>
			<form name="login_form" action="" method="POST">

				<p>Username</p>
				<input type="text" name="uname" id="uname" >

				<p>Password</p>
				<input type="password" name="pwd" id="pwd" >

				<input type="submit" value="Log In" name="submit_btn">
				<br><br>
				<label>Forgot password? <a href="forget_pwd.php"> Reset password</a></label>

			</form>

	</div>

    <?php
   
	if(isset($_POST["submit_btn"]))
	{	
		
			$res=mysqli_query($link,"select * from admin_login");
				$count = 0;
				while($row=mysqli_fetch_array($res))
				{
					$u = strcmp($row["username"], $_POST["uname"]);
					$verify = password_verify($_POST["pwd"],$row["password"]);

					if($u == 0)
					{
						if($verify)
						{
							$_SESSION["admin"]=$row["admin_ID"];
							$count++;
							?>
        					<script type="text/javascript">
								window.location="dashboard.php";
        					</script>
        					<?php
						}
						
					}
				}

					$u = strcmp("", $_POST["uname"]);
					$p = strcmp("", $_POST["pwd"]);
				if($count == 0 && $u != 0 && $p != 0)
				{
						?>
        				<script type="text/javascript">
							swal({
    							title: "Admin Login",
    							text: "Invalid Login",
    							icon: "error"
							}).then(function() {
    							window.location = "admin_login.php";
							});
        				</script>
        				<?php
				}
				if($u == 0 || $p == 0)
				{
						?>
        				<script type="text/javascript">
							swal({
    							title: "Admin Login",
    							text: "Fields Can't be empty",
    							icon: "info"
							}).then(function() {
    							window.location = "admin_login.php";
							});
        				</script>
        				<?php
				}

	}
	?>


</body>
</html>