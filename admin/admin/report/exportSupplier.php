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

 $result = mysqli_query($link, "select * from supplier");  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>ADMIN | Supplier Report</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:70%;">  
                <h3 align="center">Suppliers Data</h3>                 
                <br />  
                <form method="post" action="exportsupplierCSV.php" align="center">  
                     <input type="submit" name="export" value="Export as CSV" class="btn btn-success" />  
                </form>  
                <br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="2.5%">ID</th>  
                               <th width="12.5%">Name</th> 
                               <th width="35%">Address</th> 
                               <th width="12.5%">Email</th>  
                               <th width="7.5%">Contact No</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["s_id"]; ?></td>  
                               <td><?php echo $row["s_name"]; ?></td>  
                               <td><?php echo $row["s_addr"]; ?></td>  
                               <td><?php echo $row["s_email"]; ?></td>  
                               <td><?php echo $row["s_phone"]; ?></td>  
                          </tr>  
                     <?php       
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  