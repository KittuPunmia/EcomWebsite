<?php 
//include('C:/xampp/php/PEAR');
require_once('C:/xampp/htdocs/ecom/resources/config.php');
//require_once("../../config.php"); ?>
<?php
if(isset($_GET['delete_slide_id'])){
	$sql1="SELECT slide_image FROM slides ";
	$sql1 .="WHERE slide_id='".escape_string($_GET['delete_slide_id']) . "' ";
	$image_query=query($sql1);
	echo $sql1;
	confirm($image_query);
$row=fetch_array($image_query);
	$sql = "DELETE FROM slides ";
    $sql .= "WHERE slide_id='" . escape_string($_GET['delete_slide_id']) . "' ";
echo $sql;
	$query=query($sql);
	confirm($query);
$target_path="../../resources/uploads/".$row['slide_image'];
unlink($target_path);
	set_message("slide Deleted");
	redirect("../../public/admin/index.php?slides");
}else{
	redirect("../../public/admin/index.php?slides");
}

?>
