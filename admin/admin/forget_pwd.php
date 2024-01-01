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
  <title>Admin - Forgot Password</title>
</head>
<body>


	<div class="login-box">
		<img src="img/avatar2.png" class="avatar">
		<h1>Get Verification Code</h1>
			<form name="login_form" action="" method="POST">

				<p>Username</p>
				<input type="text" name="uname" id="uname" >

				<input type="submit" value="Get Verification Code" name="submit_btn">
				<br><br>

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

					if($u == 0)
					{
						$_SESSION["admin"]=$row["admin_ID"];
						$count++;

						$v1=rand(1111,9999);
                        $v2=rand(1111,9999);
   
                        $v3=($v1.$v2)/100;
                        $code=intval($v3);

                        mysqli_query($link, "update admin_login set code =  $code where admin_ID = '$row[admin_ID]'");

						?>
        				<script type="text/javascript">
							window.location="mail.php?id=<?php echo $row["admin_ID"]; ?>";
        				</script>
        				<?php
					}
				}

				$u = strcmp("", $_POST["uname"]);
				if($u == 0)
				{
						?>
        				<script type="text/javascript">
							swal({
    							title: "User Name",
    							text: "User Name Can't be empty",
    							icon: "info"
							}).then(function() {
    							window.location = "forget_pwd.php";
							});
        				</script>
        				<?php
				}
				else if($count == 0)
				{
						?>
        				<script type="text/javascript">
							swal({
    							title: "User Name",
    							text: "Invalid User Name",
    							icon: "error"
							}).then(function() {
    							window.location = "forget_pwd.php";
							});
        				</script>
        				<?php
				}
				

	}
	?>


</body>
</html>