 <?php  
      //export.php  
 if(isset($_POST["export"]))  
 {  
      $link=mysqli_connect("localhost","root","");
      mysqli_select_db($link,"online_shopping");

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=products.csv');  

      $output = fopen("php://output", "w");  
      fputcsv($output, array('product_id', 'product_name', 'product_price', 'available_quantity', 'product_image', 'description', 'category', 'sub_category', 'brand', 'scale'));  

      $result = mysqli_query($link, "SELECT * from tbl_product ORDER BY product_id");  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?> 