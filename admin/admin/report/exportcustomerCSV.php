 <?php  
      //export.php  
 if(isset($_POST["export"]))  
 {  
      $link=mysqli_connect("localhost","root","");
      mysqli_select_db($link,"online_shopping");

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=customers.csv');  

      $output = fopen("php://output", "w");  
      fputcsv($output, array('Id', 'First Name', 'Last Name', 'Contact No', 'Email', 'Home No', 'Street', 'City', 'Country', 'Postal Code', 'Username', 'Password', 'Insite Coins'));  

      $result = mysqli_query($link, "SELECT * from cus_details ORDER BY Customer_ID");  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?> 