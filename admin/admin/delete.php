<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="js/sweetalert.min.js"></script>
</head>
<body>

<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
$id=$_GET["id"];
mysqli_query($link,"delete from tbl_product where product_id= $id ");
?>
<script type="text/javascript">
    swal({
        title: "Product",
        text: "Product deleted successfully!!!",
        icon: "success"
    }).then(function() {
        window.location = "product.php";
    });
</script>

</body>
</html>