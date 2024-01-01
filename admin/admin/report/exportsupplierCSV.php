 <?php  
      //export.php  
 if(isset($_POST["export"]))  
 {  
      $link=mysqli_connect("localhost","root","");
      mysqli_select_db($link,"online_shopping");

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=suppliers.csv');  

      $output = fopen("php://output", "w");  
      fputcsv($output, array('Id', 'Name', 'Address', 'Email', 'Contact No'));  

      $result = mysqli_query($link, "SELECT * from supplier ORDER BY s_id");  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?> 