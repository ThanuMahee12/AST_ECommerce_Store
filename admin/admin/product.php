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

include("pagination.php");     
    
 $query = "SELECT * FROM tbl_product LIMIT $start_from, $per_page_record";     
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
    <link rel="stylesheet" href="css/produc.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style type="text/css">
        input, button{   
        height: 34px;   
    }
    @media(max-width: 768px){
    thead{
        display: none;
    }
    tbody, tr, td{
        display: block;
        width: 100%;
    }
    tr{
        margin-bottom: 15px;
    }
     tbody tr td{
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
     td:before{
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: 600;
        font-size: 14px;
        text-align: left;
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
                <li style="background-color: #444; ">
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
                        <h2>Products</h2>
                    </div>
                    <table class="product">
                        <thead>
                            <td>#</td>
                            <td>Image</td>
                            <td>Product Name</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Category</td>
                            <td>Actions</td>
                        </thead>
                        <tbody>
                            <?php
                
                    
                    while($row=mysqli_fetch_array($rs_result))
                    {
                    echo "<tr>";
                    echo "<td data-label='#'>"; echo $row["product_id"]; echo "</td>";
                    echo "<td data-label='Image'>"; ?> <div class="img-box-small"><a href="../user/<?php echo $row["product_image"]; ?>"><img src="../user/<?php echo $row["product_image"]; ?>" /></a></div><?php  echo "</td>";
                    echo "<td data-label='Name'>"; echo $row["product_name"]; echo "</td>";
                    echo "<td data-label='Price'>"; echo $row["product_price"]; echo "</td>";
                    echo "<td data-label='Quantity'>"; echo $row["available_quantity"]; echo "</td>";
                    echo "<td data-label='Category'>"; echo $row["category"]; echo "</td>";
                    echo "<td data-label='Actions'>"; ?> 
                    <a href="view.php?id=<?php echo $row["product_id"]; ?>"> <i class="far fa-eye"></i> </a>
                    <a href="edit.php?id=<?php echo $row["product_id"]; ?>"> <i class="far fa-edit"></i> </a>
                    <a href="delete.php?id=<?php echo $row["product_id"]; ?>"> <i class="far fa-trash-alt"></i> </a> 
                    <?php echo "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";
                ?>
                        </tbody>
                    </table>
                         <div class="pagination">    
                            <?php  
                            $query = "SELECT COUNT(*) FROM tbl_product";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='product.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='product.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='product.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='product.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 

                        <div class="inline">   
                            <input id="page" type="number" min="1" max="<?php echo $total_pages?>" placeholder="<?php echo $page."/".$total_pages; ?>" required>   
                            <button onClick="go2Page();" class="btn" style="border: none;">Go</button>   
                        </div>

                </div>

                <script>   
                function go2Page()   
                {   
                    var page = document.getElementById("page").value;   
                    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
                 window.location.href = 'product.php?page='+page;   
                }   
            </script>

            </div>
        </div>
    </div>
</body>
</html>



