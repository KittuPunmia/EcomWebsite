<?php 
require_once("../../config.php"); 
if(isset($_GET['id'])){
	$sql = "DELETE FROM products ";
    $sql .= "WHERE product_id='" . escape_string($_GET['id']) . "' ";

	$query=query($sql);
	confirm($query);

	set_message("Product Deleted");
	redirect("../../../public/admin/index.php?products");
}else{
	redirect("../../../public/admin/index.php?products");
}

?>
