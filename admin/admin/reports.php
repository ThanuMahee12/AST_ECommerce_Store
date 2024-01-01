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
    <style type="text/css">
        .fa-print{
    background: #ed5564;
    }
    </style>
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
                <li style="background-color: #444;">
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
                        <h2>Reports</h2>
                    </div>
                    <table class="appointments">
                        <thead>
                            <td>Report Name</td>
                            <td>Annual Report</td>
                            <td>Monthly Report</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales Report</td>
                                <td> <a href="report/annualSales.php"><i style="padding: 5px 50px 5px 50px;" class="far fa-print"></i></a></td>
                                <td> <a href="report/monthlySales.php"><i style="padding: 5px 50px 5px 50px;" class="far fa-print"></i></a></td>
                            </tr>
                            <tr>
                                <td>Payments Report</td>
                                <td> <a href="report/annualPayments.php"><i style="padding: 5px 50px 5px 50px;" class="far fa-print"></i></a></td>
                                <td> <a href="report/monthlyPayments.php"><i style="padding: 5px 50px 5px 50px;" class="far fa-print"></i></a></td>
                            </tr>
                            <tr>
                                <td>Purchase Order Report</td>
                                <td> <a href="report/annualPo.php"><i style="padding: 5px 50px 5px 50px;" class="far fa-print"></i></a></td>
                                <td> <a href="report/monthlyPo.php"><i style="padding: 5px 50px 5px 50px;" class="far fa-print"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="doctor-visiting">
                    <div class="heading">
                        <h2>Reports</h2>
                    </div>
                    <table class="visiting">
                        <thead>
                            <td>Report</td>
                            <td>Print</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Customer Details</td>
                                <td><a href="report/exportCustomer.php"> <i class="far fa-print"></i></a></td>
                            </tr>
                            <tr>
                                <td>Product Details</td>
                                <td><a href="report/exportProduct.php"> <i class="far fa-print"></i></a></td>
                            </tr>
                            <tr>
                                <td>Supplier Details</td>
                                <td><a href="report/exportSupplier.php"> <i class="far fa-print"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



