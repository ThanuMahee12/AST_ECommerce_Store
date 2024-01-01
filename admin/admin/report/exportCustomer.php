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

 $result = mysqli_query($link, "select * from cus_details");  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>ADMIN | Customer Report</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:100%;">  
                <h3 align="center">Customers Data</h3>                 
                <br />  
                <form method="post" action="exportcustomerCSV.php" align="center">  
                     <input type="submit" name="export" value="Export as CSV" class="btn btn-success" />  
                </form>  
                <br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">ID</th>  
                               <th width="7.5%">First Name</th>  
                               <th width="7.5%">Last Name</th>  
                               <th width="7.5%">Contact No</th>  
                               <th width="12.5%">Email</th>  
                               <th width="5%">Home No</th> 
                               <th width="10%">Street</th>
                               <th width="10%">City</th>
                               <th width="10%">Country</th>
                               <th width="7.5%">Postal Code</th> 
                               <th width="10%">Username</th>  
                               <th width="7.5%">Insite Coins</th>  
                          </tr>  
                     <?php  
                     while($row = mysqli_fetch_array($result))  
                     {  
                     ?>  
                          <tr>  
                               <td><?php echo $row["Customer_ID"]; ?></td>  
                               <td><?php echo $row["firstName"]; ?></td>  
                               <td><?php echo $row["lastName"]; ?></td>  
                               <td><?php echo $row["contact_number"]; ?></td>  
                               <td><?php echo $row["email"]; ?></td>  
                               <td><?php echo $row["HomeNo"]; ?></td> 
                               <td><?php echo $row["street"]; ?></td> 
                               <td><?php echo $row["city"]; ?></td> 
                               <td><?php echo $row["country"]; ?></td> 
                               <td><?php echo $row["postalcode"]; ?></td> 
                               <td><?php echo $row["username"]; ?></td> 
                               <td><?php echo $row["insite_coins"]; ?></td>  
                          </tr>  
                     <?php       
                     }  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  