<?php 
require_once("../../config.php"); 
if(isset($_GET['id'])){
	$sql = "DELETE FROM users ";
    $sql .= "WHERE user_id='" . escape_string($_GET['id']) . "' ";

	$query=query($sql);
	confirm($query);

	set_message("Product Deleted");
	redirect("../../../public/admin/index.php?users");
}else{
	redirect("../../../public/admin/index.php?users");
}

?>
