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
    
 $query = "SELECT * FROM category LIMIT $start_from, $per_page_record";     
 $rs_result = mysqli_query ($link, $query);  

 $query1 = "SELECT * FROM sub_category LIMIT $start_from, $per_page_record";     
 $rs_result1 = mysqli_query ($link, $query1);    

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
      <script src="js/sweetalert.min.js"></script>
    <style type="text/css">
        input, button{   
        height: 34px;   
    } 
    .divide-3 {
    width: 100%;
    display: grid;
    grid-template-columns: 1.5fr 1.5fr;
    grid-gap: 20px;
    align-items: self-start;
    padding: 0 20px 20px 20px;
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
                    <a href="category.php" style="background-color: #444; ">
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
            <br><br><br><br><br>

            <div class="tables">
                <div class="divide-3">
                    <div class="add">
                        <div class="heading">
                        <h2>Categories</h2>
                    </div>
                    <table class="product">
                        <thead>
                            <td>Category ID</td>
                            <td>Category Name</td>
                            <td>Delete</td>
                        </thead>
                        <tbody>
                            <?php
                
                    
                    while($row=mysqli_fetch_array($rs_result))
                    {
                    echo "<tr>";
                    echo "<td>"; echo $row["category_id"]; echo "</td>";
                    echo "<td>"; echo $row["category_name"]; echo "</td>";
                    echo "<td>"; ?> <a href="deletecategory.php?id=<?php echo $row["category_id"]; ?>"> <i class="far fa-trash-alt"></i> </a> <?php echo "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";
                ?>
                        </tbody>
                    </table>
                         <div class="pagination">    
                            <?php  
                            $query = "SELECT COUNT(*) FROM category";     
                            $rs_result = mysqli_query($link, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $total_records = $row[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='category.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='category.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='category.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='category.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 

                        <div class="inline">   
                            <input id="page" type="number" min="1" max="<?php echo $total_pages?>" placeholder="<?php echo $page."/".$total_pages; ?>" required>   
                            <button onClick="go2Page();" class="btn" style="border: none;">Go</button>   
                            <script>   
                                function go2Page()   
                                {   
                                    var page = document.getElementById("page").value;   
                                    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
                                    window.location.href = 'category.php?page='+page;   
                                }   
                            </script>
                        </div> 
                </div>
                <div class="add">
                                        <div class="heading">
                        <h2>Sub Categories</h2>
                    </div>
                    <table class="product">
                        <thead>
                            <td>Sub category ID</td>
                            <td>Sub category Name</td>
                            <td>Delete</td>
                        </thead>
                        <tbody>
                            <?php
                
                    
                    while($row1=mysqli_fetch_array($rs_result1))
                    {
                    echo "<tr>";
                    echo "<td>"; echo $row1["category_id"]; echo "</td>";
                    echo "<td>"; echo $row1["category_name"]; echo "</td>";
                    echo "<td>"; ?> <a href="deletesub.php?id=<?php echo $row1["category_id"]; ?>"> <i class="far fa-trash-alt"></i> </a> <?php echo "</td>";
                    echo "</tr>";
                    }
                    echo "</table>";
                ?>
                        </tbody>
                    </table>
                         <div class="pagination">    
                            <?php  
                            $query1 = "SELECT COUNT(*) FROM sub_category";     
                            $rs_result1 = mysqli_query($link, $query1);     
                            $row1 = mysqli_fetch_row($rs_result1);     
                            $total_records = $row1[0];     
          
                            echo "</br>";     
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
      
                            if($page>=2){   
                                echo "<a href='category.php?page=".($page-1)."'>  Prev </a>";   
                            }       
                   
                            for ($i=1; $i<=$total_pages; $i++) {   
                                if ($i == $page) {   
                                    $pagLink .= "<a class = 'active' href='category.php?page=".$i."'>".$i." </a>";   
                                 }               
                                else  {   
                                    $pagLink .= "<a href='category.php?page=".$i."'>".$i." </a>";     
                                }   
                            };     
                            echo $pagLink;   
  
                            if($page<$total_pages){   
                                echo "<a href='category.php?page=".($page+1)."'>  Next </a>";   
                            }   
  
                            ?>    
                        </div> 

                        <div class="inline">   
                            <input id="page1" type="number" min="1" max="<?php echo $total_pages?>" placeholder="<?php echo $page."/".$total_pages; ?>" required>   
                            <button onClick="go2Page1();" class="btn" style="border: none;">Go</button>   
                            <script>   
                                function go2Page1()   
                                {   
                                    var page = document.getElementById("page1").value;   
                                    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
                                    window.location.href = 'category.php?page='+page;   
                                }   
                            </script>
                        </div>
                        
                </div>
            </div>
            <div class="divide-3">
            <div class="add">
                <div class="heading"><h2>Add category</h2></div><br><hr style="width: 100%;"><br>

                    <form method="POST" enctype="multipart/form-data">

                        <label>Category Name  </label>
                        <input type="text" name="cat">
                        <br><br>

                        <input type="submit" name="change_cat" value="ADD" class="btn" style="border-color: transparent; width: 100%; font-weight: bold; cursor:pointer;">
                    </form>
                        <?php
                        if(isset($_POST["change_cat"]))
                        {
                            
                            if($_POST["cat"] == "" )
                            {
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Category",
                                        text: "Invalid Category!!!",
                                        icon: "error"
                                    }).then(function() {
                                    window.location = "category.php";
                                });
                                </script>
                                <?php
                            }
                            else
                            {

                                mysqli_query($link,"insert into category value('','$_POST[cat]')");
                    
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Category",
                                        text: "Category added successfully!!!",
                                        icon: "success"
                                    }).then(function() {
                                    window.location = "category.php";
                                });
                                </script>
                                <?php
                            }
                        }
                        ?>
            </div>
            <div class="add">
                <div class="heading"><h2>Add sub category</h2></div><br><hr style="width: 100%;"><br>

                    <form method="POST" enctype="multipart/form-data">

                        <label>Sub category Name  </label>
                        <input type="text" name="subcat">
                        <br><br>

                        <input type="submit" name="change_subcat" value="ADD" class="btn" style="border-color: transparent; width: 100%; font-weight: bold; cursor:pointer;">
                    </form>
                        <?php
                        if(isset($_POST["change_subcat"]))
                        {
                            
                            if($_POST["subcat"] == "" )
                            {
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Sub Category",
                                        text: "Invalid Sub Category!!!",
                                        icon: "error"
                                    }).then(function() {
                                    window.location = "category.php";
                                });
                                </script>
                                <?php
                            }
                            else
                            {

                                mysqli_query($link,"insert into sub_category value('','$_POST[subcat]')");
                    
                                ?>
                                <script type="text/javascript">
                                swal({
                                        title: "Sub Category",
                                        text: "Sub category added successfully!!!",
                                        icon: "success"
                                    }).then(function() {
                                    window.location = "category.php";
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



