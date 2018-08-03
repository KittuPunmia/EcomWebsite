<?php 
require("../../config.php"); 
if(isset($_GET['delete_slide_id'])){
	$sql = "DELETE FROM slides ";
    $sql .= "WHERE slide_id='" . escape_string($_GET['delete_slide_id']) . "' ";

	$query=query($sql);
	confirm($query);

	set_message("Slide Deleted");
	redirect("../../../public/admin/index.php?slides");
}else{
	redirect("../../../public/admin/index.php?slides");
}

?>
