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

 $result = mysqli_query($link, "select * from tbl_product");  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>ADMIN | Product Report</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:100%;">  
                <h3 align="center">Products Data</h3>                 
                <br />  
                <form method="post" action="exportproductCSV.php" align="center">  
                     <input type="submit" name="export" value="Export as CSV" class="btn btn-success" />  
                </form>  
                <br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">ID</th>  
                               <th width="10%">Name</th>  
                               <th width="10%">Price</th>  
                               <th width="5%">Quantity</th>  
                               <th width="30%">Description</th>  
                               <th width="10%">Category</th> 
                               <th width="10%">Sub Category</th>
                               <th width="5%">Brand</th>
                               <th width="5%">Scale</th>
                               <th width="10%">image</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["product_id"]; ?></td>  
                               <td><?php echo $row["product_name"]; ?></td>  
                               <td><?php echo $row["product_price"]; ?></td>  
                               <td><?php echo $row["available_quantity"]; ?></td>  
                               <td><?php echo $row["description"]; ?></td>  
                               <td><?php echo $row["category"]; ?></td> 
                               <td><?php echo $row["sub_category"]; ?></td> 
                               <td><?php echo $row["brand"]; ?></td> 
                               <td><?php echo $row["scale"]; ?></td> 
                               <td><div class="img-box-small"><a href="../../user/<?php echo $row["product_image"]; ?>"><img width="70px" height="50px" src="../../user/<?php echo $row["product_image"]; ?>" /></a></div></td>  
                          </tr>  
                     <?php       
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  