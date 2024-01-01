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

 $query = "SELECT * FROM tbl_order order by order_id desc LIMIT 10";     
 $rs_result = mysqli_query ($link, $query); 

$user = $_SESSION["admin"];
$res1= mysqli_query($link,"select * from admin_login where admin_ID = '$user' ");
while($row1=mysqli_fetch_array($res1))
{  $image= $row1["admin_img"]; }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <title>Admin panel</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <?php include("admin_logo.php"); ?>
                <li style="background-color: #444; ">
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
                    <a href="setting.php">
                        <i class="fas fa-cog"></i>
                        <div class="title">Settings</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            
            <?php include("topbar.php"); ?>
            <?php include("cards.php"); ?>
            
            <div class="tables">
                <div class="last-appointments">
                    <div class="heading">
                        <h2>Recent Orders</h2>
                    </div>
                    <table class="appointments">
                        <thead>
                            <td>#</td>
                            <td>Order Date</td>
                            <td>User Name</td>
                            <td>Total</td>
                            <td>View</td>
                        </thead>
                        <tbody>
                            <?php
                
                    
                    while($row=mysqli_fetch_array($rs_result))
                    {
                    echo "<tr>";
                    echo "<td>"; echo $row["order_id"]; echo "</td>";
                    echo "<td>"; echo $row["order_date"]; echo "</td>";

                        $c_id = $row["Customer_ID"];
                        $r = mysqli_query($link,"select * from cus_details where Customer_ID = $c_id ");
                        while($rw=mysqli_fetch_array($r))
                        {
                            echo "<td>"; echo $rw["username"]; echo "</td>";
                        }

                        $order_id = $row["order_id"];

                        $result = mysqli_query($link, "select SUM(total) AS total_amount from order_product where order_id = '$order_id' "); 
                        $row_new = mysqli_fetch_assoc($result); 
                        $sum = $row_new['total_amount'];
                        mysqli_query($link,"update tbl_order set total = '$sum' where order_id = '$order_id' ");

                    echo "<td>"; echo $row["total"]; echo "</td>";
                    echo "<td>"; ?> <a href="view_order.php?id=<?php echo $row["order_id"]; ?>"> <i class="far fa-eye"></i> </a> <?php echo "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";
                ?>
                        </tbody>
                    </table>
                </div>
                <div class="doctor-visiting">
                    <div class="heading">
                        <h2>Products Short View</h2>
                    </div>
                    <table class="visiting">
                        <thead>
                            <td>Image</td>
                            <td>Name</td>
                            <td>View</td>
                        </thead>
                        <tbody>
                <?php
                    $query1 = "SELECT * FROM tbl_product order by product_id desc LIMIT 10";     
                    $rs_result1 = mysqli_query ($link, $query1); 
                    
                    while($row1=mysqli_fetch_array($rs_result1))
                    {
                    echo "<tr>";
                    echo "<td>"; ?> <div class="img-box-small"><a href="../user/<?php echo $row1["product_image"]; ?>"><img src="../user/<?php echo $row1["product_image"]; ?>" /></a></div><?php  echo "</td>";
                    echo "<td>"; echo $row1["product_name"]; echo "</td>";
                    echo "<td>"; ?> <a href="view.php?id=<?php echo $row1["product_id"]; ?>"> <i class="far fa-eye"></i> </a> <?php echo "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



