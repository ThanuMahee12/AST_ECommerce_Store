<?php
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
window.location="admin_login.php";
</script>
<?php
}

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");

$user = $_SESSION["admin"];
$res= mysqli_query($link,"select * from admin_login where admin_ID = '$user' ");
while($row=mysqli_fetch_array($res))
{
    $uname= $row["username"];
    $pwd= $row["password"];
    $email= $row["email"];
    $image= $row["admin_img"]; 
}

$web= mysqli_query($link,"select * from website where id = 1 ");
while($row_web=mysqli_fetch_array($web))
{
    $name= $row_web["name"];
    $logo= $row_web["logo"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/produc.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="js/sweetalert.min.js"></script>
    <style type="text/css">
.divide-3 {
    width: 100%;
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
.divide-3-3 {
    width: 100%;
    display: grid;
    grid-template-columns: 0.5fr 2fr 0.5fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
.divide-3-by-3{
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 2fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
.textimg
{
    width: 100%;
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
input[type="password"]
{
    color: gray;
    background-color: transparent;
    border-color: transparent;
    border-bottom: 2px solid lightgray;
    height: 25px;
    width: 300px;
}
@media(max-width: 768px){
    .divide-3 {
    width: 100%;
    display: grid;
    grid-template-columns: 3fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
.divide-3-3 {
    width: 100%;
    display: grid;
    grid-template-columns: 3fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
.divide-3-by-3{
    width: 100%;
    display: grid;
    grid-template-columns: 3fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
.textimg
{
    width: 100%;
    display: grid;
    grid-template-columns: 3fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
}
}

    </style>

    <title>Admin panel</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <?php include("admin_logo.php"); ?>
                <li>
                    <a href="dashboard.php">
                        <i class="fas fa-th-large"></i>
                        <div class="title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="product.php">
                        <i class="fab fa-product-hunt"></i>
                        <div class="title">Products</div>
                    </a>
                </li>
                <li>
                    <a href="category.php">
                        <i class="fab fa-product-hunt"></i>
                        <div class="title">Product Categories</div>
                    </a>
                </li>
                <li>
                    <a href="order.php">
                        <i class="fad fa-cart-arrow-down"></i>
                        <div class="title">Orders</div>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="fas fa-user"></i>
                        <div class="title">User Details</div>
                    </a>
                </li>
                <li>
                    <a href="payment.php">
                        <i class="fas fa-hand-holding-usd"></i>
                        <div class="title">Payments</div>
                    </a>
                </li>
                <li>
                    <a href="p_order.php">
                        <i class="fas fa-cart-arrow-down"></i>
                        <div class="title">Purchase Orders</div>
                    </a>
                </li>
                <li>
                    <a href="supplier.php">
                        <i class="fas fa-user-circle"></i>
                        <div class="title">Suppliers Details</div>
                    </a>
                </li>
                <li>
                    <a href="GRN.php">
                        <i class="fas fa-coins"></i>
                        <div class="title">GRN</div>
                    </a>
                </li>
                <li>
                    <a href="invoice.php">
                        <i class="fad fa-clipboard-list-check"></i>
                        <div class="title">Supplier Invoice</div>
                    </a>
                </li>
                <li>
                    <a href="reports.php">
                        <i class="fad fa-book"></i>
                        <div class="title">Reports</div>
                    </a>
                </li>
                <li>
                    <a href="setting.php" style="background-color: #444;">
                        <i class="fas fa-cog"></i>
                        <div class="title">Settings</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            
            <?php include("topbar.php"); ?>
            <br><br><br><br><br>
            <div class="tables">
                <div class="divide-3">
                    <div class="add">
                        <div class="heading"><h2>ADMIN PROFILE</h2></div><br><hr style="width: 100%;"><br>

                        <form method="POST" enctype="multipart/form-data">
                        <div class="textimg">
                            <div class="text">

                            <label>Admin Name&ensp;&ensp;  </label>
                            <input type="text" name="name" value="<?php echo $uname; ?>" style="width: 250px;">
                            <br><br>

                            <label>Admin Image &ensp;</label>
                            <input type="file" name="pimage">
                            <br><br>

                            <label>Admin Email&ensp;&ensp;</label>
                            <input type="text" name="email" value="<?php echo $email; ?>" style="width: 250px;">
                            <br><br>

                            </div>
                            <div class="img-box-update" style="width: 200px; height: 160px;">
                                <img src="img/Admin/<?php echo $image; ?>"/>
                            </div>
                        </div>
                            <br>
                            <input type="submit" name="submit_btn" value="UPDATE PROFILE" class="btn" style="border-color: transparent; width: 100%; font-weight: bold; cursor:pointer;">
                        </form>
                        <?php
                        if(isset($_POST["submit_btn"]))
                        {
                            $fnm=$_FILES["pimage"]["name"];
                            
                            if($_POST["name"] == "" || $_POST["email"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Admin Profile",
                                        text: "Fields Can't be empty!!!",
                                        icon: "error"
                                    }).then(function() {
                                    window.location = "setting.php";
                                });
                                </script>
                                <?php
                            }
                            else
                            {
                                if($fnm=="")
                                {

                                    mysqli_query($link,"Update admin_login set username='$_POST[name]',email='$_POST[email]' where admin_ID='$user'");
                    
                                }
                                else
                                {
                                    $v1=rand(1,9);
                                    $v2=rand(1,9);
   
                                    $v3=$v1.$v2;
    
                                    $fnm=$_FILES["pimage"]["name"];
                                    $dst="img/Admin/".$v3.$fnm;
                                    $dst1=$v3.$fnm;
                                    move_uploaded_file($_FILES["pimage"]["tmp_name"],$dst);
                
                
                                    mysqli_query($link,"Update admin_login set admin_img='$dst1', username='$_POST[name]',email='$_POST[email]' where admin_ID='$user'");
        
                                }
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Admin Profile",
                                        text: "Admin profile has been updated!!!",
                                        icon: "success"
                                    }).then(function() {
                                    window.location = "setting.php";
                                });
                                </script>
                                <?php
                            }
                        }
                        ?>
                        
                </div>
                <div class="add">
                    <div class="heading"><h2>CHANGE PASSWORD</h2></div><br><hr style="width: 100%; color: lightgray;"><br>

                    <form method="POST" enctype="multipart/form-data">

                        <label>Current Password  </label><br>
                        <input type="password" name="c_pwd">
                        <br><br>

                        <label>New Password </label><br>
                        <input type="password" name="n_pwd">
                        <br><br>

                        <label>Re-Enter Password</label><br>
                        <input type="password" name="re_pwd">
                        <br><br>

                        <input type="submit" name="change_btn" value="CHANGE PASSWORD" class="btn" style="border-color: transparent; width: 100%; font-weight: bold; margin-top: 12px; cursor:pointer;">
                    </form>
                        <?php
                        if(isset($_POST["change_btn"]))
                        {


                            $respwd=mysqli_query($link,"select password from admin_login where admin_ID='$user'");
                            $rowpwd = mysqli_fetch_row($respwd);
                            $decrypt_pwd = $rowpwd[0];

                            $verify = password_verify($_POST["c_pwd"],$decrypt_pwd);

                            if($verify)
                            {
                                if($_POST["n_pwd"] != $_POST["re_pwd"])
                                {
                                    ?>
                                    <script type="text/javascript">
                                        swal({
                                            title: "Admin Profile",
                                            text: "Password not matched. Not able to update the password. Try again!!!",
                                            icon: "error"
                                        }).then(function() {
                                            window.location = "setting.php";
                                        });
                                    </script>
                                    <?php
                                }
                                else
                                {
                                    $encrypt_pwd = password_hash($_POST["n_pwd"], PASSWORD_DEFAULT);
                                    mysqli_query($link,"Update admin_login set password='$encrypt_pwd' where admin_ID='$user'");
                    
                                    ?>
                                    <script type="text/javascript">
                                        swal({
                                            title: "Admin Profile",
                                            text: "Password changed successfully!!!",
                                            icon: "success"
                                        }).then(function() {
                                            window.location = "setting.php";
                                        });
                                    </script>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Admin Profile",
                                        text: "Invalid Password!!!",
                                        icon: "error"
                                    }).then(function() {
                                    window.location = "setting.php";
                                });
                                </script>
                                <?php
                            }
                        }
                        ?>
                        
                </div>
            </div>

            </div>
        </div>
    </div>
</body>



</html>



