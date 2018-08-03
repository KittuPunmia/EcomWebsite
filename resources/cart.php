<?php require_once("config.php");  ?>
<?php


if(isset($_GET['add'])){
	$query=query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add'])." ");
	confirm($query);
	while ($row=fetch_array($query)) {
		# code...
		if($row['product_quantity']!=$_SESSION['product_' . $_GET['add']]){

			$_SESSION['product_' . $_GET['add']]+=1;
			redirect("../public/checkout.php");
		}else{

				set_message("We only have " .$row['product_quantity']." ". $row['product_title']."'s available");
				redirect("../public/checkout.php");
		}
	}

}
if(isset($_GET['remove'])){

$_SESSION['product_' . $_GET['remove']]--;
	if($_SESSION['product_' . $_GET['remove']] < 1){
		unset($_SESSION[item_total]);
unset($_SESSION[item_count]);

       redirect("../public/checkout.php");
	}else
	{
      redirect("../public/checkout.php");

	}
}
if(isset($_GET['delete'])){

$_SESSION['product_' . $_GET['delete']]='0';
unset($_SESSION[item_total]);
unset($_SESSION[item_count]);

redirect("../public/checkout.php");
}


function cart(){
$total=0;
$count=0;
$_SESSION['item_rows']=0;
$item_name=1;
$item_number=1;
$amount=1;
$quantity=1;
foreach ($_SESSION as $name => $value) {
	# code...\
	if($value > 0){

		if(substr($name,0,8)=="product_"){
			$length=strlen($name);
			$id=substr($name,8,$length);

$query=query("SELECT * FROM products WHERE product_id=" .escape_string($id)." ");
confirm($query);

while($row=fetch_array($query)){
$sub=$row['product_prize']*$value;
$product_image=display_image($row['product_image']);
$product = <<<DELIMITER
<tr>
        <td>{$row['product_title']}<br>
        <img width="100" src="../resources/{$product_image}"></img></td>
        <td>&#8377;{$row['product_prize']}</td>
        <td>{$value}</td>
        <td>&#8377;{$sub}</td>
        <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
        <a class='btn btn-success' href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></a>
        <a class='btn btn-danger' href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></a>
          
        </td>

    </tr>
    <input type="hidden" id="item_name_{$item_name}" name="item_name_{$item_name}" value="{$row['product_title']}">
          <input type="hidden" id="item_number_{$item_number}" name="item_number_{$item_number}" value="{$row['product_id']}">
          <input type="hidden" id="amount_{$amount}" name="amount_{$amount}" value="{$row['product_prize']}">
          <input type="hidden" id="quantity_{$quantity}" name="quantity_{$quantity}" value="{$value}">

    
  
DELIMITER;
echo $product;
//paypal also above 3 input statements
$item_name++;
$item_number++;
$amount++;
$quantity++;
$_SESSION['item_rows']++;
$_SESSION['item_total']=$total+=$sub;
$_SESSION['item_count']=$count+=$value;
}

		}
	}
}

}
?>