<?php
$uploaddirectory="uploads";
//helper functions

function set_message($msg){
if(!empty($msg)){
	$_SESSION['message']=$msg;
}else{
	$msg="";
}
}
function display_message(){
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);

	}
}
function redirect($location){

	header("Location: $location ");
}
function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);

}
function confirm($result){
	global $connection;
	if(!$result){
		die("QUERY FAILED" .mysqli_error($connection));
	}
}
function escape_string($string){

	global $connection;
	return mysqli_real_escape_string($connection,$string);

}
function fetch_array($result){
	return mysqli_fetch_array($result);
}
//***************FRONT_END_FUNCTIONS



function get_products() {


$query = query(" SELECT * FROM products");
confirm($query);

$rows = mysqli_num_rows($query); // Get total of mumber of rows from the database


if(isset($_GET['page'])){ //get page from URL if its there

    $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers



} else{// If the page url variable is not present force it to be number 1

    $page = 1;

}


$perPage = 3; // Items per page here 

$lastPage = ceil($rows / $perPage); // Get the value of the last page


// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

if($page < 1){ // If it is less than 1

    $page = 1; // force if to be 1

}elseif($page > $lastPage){ // if it is greater than $lastpage

    $page = $lastPage; // force it to be $lastpage's value

}



$middleNumbers = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons


$sub1 = $page - 1;
$sub2 = $page - 2;
$add1 = $page + 1;
$add2 = $page + 2;



if($page == 1){

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

} elseif ($page == $lastPage) {
    
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

}elseif ($page > 2 && $page < ($lastPage -1)) {

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

         $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';

     


} elseif($page > 1 && $page < $lastPage){

     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

     $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';
 
     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';


     


}


// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query


$limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;




// $query2 is what we will use to to display products with out $limit variable

$query2 = query(" SELECT * FROM products $limit");
confirm($query2);


$outputPagination = ""; // Initialize the pagination output variable


// if($lastPage != 1){

//    echo "Page $page of $lastPage";


// }


  // If we are not on page one we place the back link

if($page != 1){


    $prev  = $page - 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
}

 // Lets append all our links to this variable that we can use this output pagination

$outputPagination .= $middleNumbers;


// If we are not on the very last page we the place the next link

if($page != $lastPage){


    $next = $page + 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';

}


// Doen with pagination



// Remember we use query 2 below :)

while($row = fetch_array($query2)) {

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER

<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img style="height:200px" src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#8377;{$row['product_prize']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>


       
    </div>
</div>

DELIMETER;

echo $product;


		}


       echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";


}



function get_orders(){
$query=query("SELECT * FROM orders");
confirm($query);
while($row = fetch_array($query)){

$order = <<<DELIMITER

<tr>
                        <td>{$row['ORDERID']}</td>
                        <td>{$row['TXNAMOUNT']}</td>

                        <td>{$row['CURRENCY']}</td>
                        <td>{$row['STATUS']}</td>
                        <td>{$row['TXN_DATE']}</td>
                    </tr>
                    
DELIMITER;
echo $order;

}


}

function get_orders_in_dashboard(){
$query=query("SELECT * FROM orders");
confirm($query);
while($row = fetch_array($query)){

$order = <<<DELIMITER

<tr>
                        <td>{$row['ORDERID']}</td>
                        <td>{$row['TXNAMOUNT']}</td>

                        <td>{$row['STATUS']}</td>
                        <td>{$row['TXN_DATE']}</td>
                    </tr>
                    
DELIMITER;
echo $order;

}


}















function get_categories(){

$query=query("SELECT * FROM categories");
confirm($query);
while($row = fetch_array($query)){

$category_links = <<<DELIMITER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMITER;

echo $category_links;
	}

}

function get_category_detail($string=""){
	$query=query("SELECT * FROM products WHERE product_category_id=".escape_string($string)." ");
confirm($query);
while($row = fetch_array($query)){
$product_image=display_image($row['product_image']);

$category_detail = <<<DELIMITER

<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMITER;
echo $category_detail;
}
}
function get_category_detail_in_shop(){
	$query=query("SELECT * FROM products");
confirm($query);
while($row = fetch_array($query)){
$product_image=display_image($row['product_image']);

$category_detail = <<<DELIMITER

<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMITER;
echo $category_detail;
}
}
function login_user(){
	if(isset($_POST['submit'])){
	$user_name=escape_string($_POST['username']);
	$password=escape_string($_POST['password']);

	$query=query("SELECT * FROM users WHERE user_name='{$user_name}' AND password='{$password}' ")	;
	confirm($query);
	//echo $query;
	if(mysqli_num_rows($query) == 0 ) {
		$query=query("SELECT * FROM customers WHERE user_name='{$user_name}' AND password='{$password}' ")	;
	confirm($query);
	//echo $query;
	if(mysqli_num_rows($query) == 0 ) {
		set_message("Your password or username is wrong");
			redirect("login.php");

      }else{
      	$_SESSION['user']=$user_name;
      	redirect("index.php");
      }

	}else{
		//set_message("WELCOME TO ADMIN {$user_name}")
		$_SESSION['user_name']=$user_name;
	redirect("admin");

	}
	}
}

function send_message(){
		if(isset($_POST['submit'])){
			$to         = "kittu97punmia@gmail.com";
			$from_name  = $_POST['name'];
			$subject    = $_POST['subject']; 
			$email      = $_POST['email']; 
			$message    = $_POST['message'];
			$headers    = "From: {$from_name} {$email}";
			$result     = mail($to,$subject,$message,$headers);
			if(!result){
				echo "ERROR";
			}else{
				echo "sent";
			}
			}
}
function displaylogout(){

$logout = <<<DELIMITER

<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{$_SESSION['user']}
<b class="caret"></b></a>
<ul class="dropdown-menu">

<li class="divider"></li>
<li>
<a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
</li>
</ul>

DELIMITER;
echo $logout;
}

function displaytext(){
$text = <<<DELIMITER
<a> NOT LOGGED IN</a>
DELIMITER;
echo $text;
}
//***********BACKEND FUNCTIONS***************



//**********products in admin


function display_image($picture){
	global $uploaddirectory;
return $uploaddirectory . DS . $picture;

}
function get_products_in_admin(){
	$query=query("SELECT * FROM products");
	confirm($query);

	while ($row=  fetch_array($query)) {
		# code...
		//echo $row['product_prize'];
	
$categoryid=find_category_by_id($row['product_category_id']);
$product_image=display_image($row['product_image']);
$product = <<<DELIMITER
  <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
          <a href="index.php?edit_product&id={$row['product_id']}">
          <img width="150" src="../../resources/{$product_image}" alt=""></img></a>
            </td>
            <td>{$categoryid}</td>
            <td>{$row['product_prize']}</td>
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}" > <span class="glyphicon-remove"></span></a></td>
        </tr>
      

DELIMITER;

echo $product;
	}
}
function file_upload_error($error_integer) {
  $upload_errors = array(
    // http://php.net/manual/en/features.file-upload.errors.php
    UPLOAD_ERR_OK         => "No errors.",
    UPLOAD_ERR_INI_SIZE   => "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE  => "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL    => "Partial upload.",
    UPLOAD_ERR_NO_FILE    => "No file.",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
    UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
  );
  return $upload_errors[$error_integer];
}
function addproduct(){

if(isset($_POST['submit'])){
$product_title=escape_string($_POST['product_title']);
$product_description=escape_string($_POST['product_description']);
$product_price=escape_string($_POST['product_price']);
$product_category_id=escape_string($_POST['product_category_id']);
$short_desc=escape_string($_POST['short_desc']);
$product_quantity=escape_string($_POST['product_quantity']);
$product_image=escape_string($_FILES['file']['name']);
//echo $product_image;
$image_temp_location=escape_string($_FILES['file']['tmp_name']);
$error = $_FILES['file']['error'];
echo $image_temp_location;
$a=move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
$uploadfile=UPLOAD_DIRECTORY. DS . basename($_FILES['file']['name']);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$sql = "INSERT INTO products ";
    $sql .= "(product_title, product_description, product_prize, product_category_id, short_desc,product_quantity,product_image) ";
    $sql .= "VALUES (";
    $sql .= "'" . escape_string($product_title) . "',";
    $sql .= "'" . escape_string($product_description) . "',";
    $sql .= "'" . escape_string($product_price) . "',";
    $sql .= "'" . escape_string($product_category_id) . "',";
    $sql .= "'" . escape_string($short_desc) . "',";
    $sql .= "'" . escape_string($product_quantity) . "',";
    $sql .= "'" . escape_string($product_image
    	) . "'";
    $sql .= ")";
    echo $sql;
    $query=query($sql);
confirm($query);
set_message("New product just added");


} else {
  echo "Error" . file_upload_error($error);
  set_message("SOME ERROR IN UPLOADING FILE" . file_upload_error($error));
echo '<pre>';
//echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";

}



    
}
}

function show_categories_add_product_page(){
	$query=query("SELECT * FROM categories");
confirm($query);
while($row = fetch_array($query)){

$category_options = <<<DELIMITER

<option value="{$row['cat_id']}">{$row['cat_title']}</option>

DELIMITER;

echo $category_options;
	}

}

function find_category_by_id($productid){
	$sql="SELECT * FROM categories ";
	$sql .="WHERE cat_id='". escape_string($productid) . "'";
	$query=query($sql);
	confirm($query);
	while($row=fetch_array($query)){
return $row['cat_title'];
	}
}

//*****UPDATING PRODUCTS
function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

function editproduct(){

if(isset($_POST['submit'])){
$product_title=escape_string($_POST['product_title']);
$product_description=escape_string($_POST['product_description']);
$product_price=escape_string($_POST['product_price']);
$product_category_id=escape_string($_POST['product_category_id']);
//set_message($product_category_id."is category id");
$short_desc=escape_string($_POST['short_desc']);
$product_quantity=escape_string($_POST['product_quantity']);
$product_image=escape_string($_FILES['file']['name']);
//echo $product_image;
$image_temp_location=escape_string($_FILES['file']['tmp_name']);
//$a=move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
$uploadfile=UPLOAD_DIRECTORY. DS . basename($_FILES['file']['name']);

if(is_blank($product_image)){
	$query=query("SELECT product_image from products where product_id='" . escape_string($_GET['id']) . "'");
	confirm($query);
	$row=fetch_array($query);
	$product_image=$row['product_image'];
}
move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
	$sql = "UPDATE products SET ";
    $sql .= "product_title='" . escape_string($product_title) . "', ";
    $sql .= "product_category_id='" . escape_string($product_category_id) . "', ";
    $sql .= "product_description='" . escape_string($product_description) . "', ";
    $sql .= "product_prize='" . escape_string($product_price) . "', ";
    $sql .= "product_quantity='" . escape_string($product_quantity) . "', ";
    $sql .= "short_desc='" . escape_string($short_desc) . "', ";
    $sql .= "product_image='" . escape_string($product_image) . "' ";
    
    $sql .= "WHERE product_id='" . escape_string($_GET['id']) . "' ";
    $sql .= "LIMIT 1";
$query=query($sql);
confirm($query);
//set_message("product is updated");
}
}


//*******categories in admin
function show_categories_in_admin(){
	$sql="SELECT * FROM categories";
	$query=query($sql);
	confirm($query);
	while($row=fetch_array($query)){

		$cat_id=$row['cat_id'];
		$cat_title=$row['cat_title'];
$category = <<<DELIMITER
<tr>
		<td>{$cat_id}</td>
		<td>{$cat_title}</td>
		<td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$cat_id}" > <span class="glyphicon-remove"></span></a></td>
        
</tr>
DELIMITER;
echo $category;
	}
}

function add_category(){
if(isset($_POST['add_category'])){
	$cat_title=escape_string($_POST['cat_title']);
	if(!is_blank($cat_title)){
	$insert_cat=query("INSERT INTO categories(cat_title) VALUES ('{$cat_title}')");
	if(mysqli_affected_rows()==0){
		set_message("Category added");
	}else{
		set_message("Category not added");

	}
	confirm($insert_cat);
	redirect("index.php?categories");
}
}

}


//************admin userds

function show_users_in_admin(){
	$sql="SELECT * FROM users";
	$query=query($sql);
	confirm($query);
	while($row=fetch_array($query)){

		$user_id=$row['user_id'];
		$user_name=$row['user_name'];
		$email=$row['email'];
$user_details = <<<DELIMITER
<tr>
		<td>{$user_id}</td>
		<td>{$user_name}</td>
		<td>{$email}</td>
		<td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$user_id}" > <span class="glyphicon-remove"></span></a></td>
        
</tr>
DELIMITER;
echo $user_details;
	}
}

function add_user(){
	if(isset($_POST['submit'])){

	$user_name=escape_string($_POST['user_name']);
	$email=escape_string($_POST['user_email']);
	$password=escape_string($_POST['user_password']);
$user_image=escape_string($_FILES['file']['name']);
//echo $product_image;
$image_temp_location=escape_string($_FILES['file']['tmp_name']);
$uploadfile=UPLOAD_DIRECTORY. DS . basename($_FILES['file']['name']);



if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$sql = "INSERT INTO users ";
    $sql .= "(user_name, email, password, user_image) ";
    $sql .= "VALUES (";
    $sql .= "'" . escape_string($user_name) . "',";
    $sql .= "'" . escape_string($email) . "',";
    $sql .= "'" . escape_string($password) . "',";
    $sql .= "'" . escape_string($user_image) . "'";
    $sql .= ")";
    echo $sql;
    $query=query($sql);
confirm($query);
set_message("New User just added");
redirect("index.php?users");

} else {
  set_message("SOME ERROR IN UPLOADING FILE");
echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";

}

	}
}

//**************************slides function
function add_slides(){

if(isset($_POST['add_slide'])){
$slide_title=escape_string($_POST['slide_title']);

$slide_image=escape_string($_FILES['file']['name']);
//echo $product_image;
$image_temp_location=escape_string($_FILES['file']['tmp_name']);
$uploadfile=UPLOAD_DIRECTORY. DS . basename($_FILES['file']['name']);

if(is_blank($slide_title) || is_blank($slide_image)){
echo "<p class='bg-danger'>This field cannot be empty</p>";

}
else
{
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	$sql = "INSERT INTO slides ";
    $sql .= "(slide_title, slide_image) ";
    $sql .= "VALUES (";
    $sql .= "'" . escape_string($slide_title) . "',";
    $sql .= "'" . escape_string($slide_image) . "'";
    $sql .= ")";
    echo $sql;
    $query=query($sql);
confirm($query);
set_message("Slide just added");
redirect("index.php?slides");

} else {
  set_message("SOME ERROR IN UPLOADING FILE");
echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";

}
}
}






}



function get_current_slides_in_admin(){
$query=query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
confirm($query);
while($row=fetch_array($query)){


$slides = <<<DELIMITER

            <img class="img-responsive" src="../../resources/uploads/{$row['slide_image']}" alt="">
        
DELIMITER;
echo $slides;
}

}



function get_active_slide(){
$query=query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
confirm($query);
while($row=fetch_array($query)){


$slides = <<<DELIMITER

<div class="item active">
            <img class="slide-image" src="../resources/uploads/{$row['slide_image']}" alt="">
</div>
        
DELIMITER;
echo $slides;
}

}






function get_slides(){
$query=query("SELECT * FROM slides");
confirm($query);
while($row=fetch_array($query)){


$slides = <<<DELIMITER

<div class="item">
            <img class="slide-image" src="../resources/uploads/{$row['slide_image']}" alt="">
</div>
        
DELIMITER;
echo $slides;
}
}


function get_slide_thumbnails(){
$query=query("SELECT * FROM slides ORDER BY slide_id ASC");
confirm($query);
while($row=fetch_array($query)){


$slides = <<<DELIMITER
<div class="col-xs-6 col-md-3 image_container">
<div class="caption">
<p class="text-center">{$row['slide_title']}</p></div>

<a href="index.php?delete_slide_id={$row['slide_id']}">

<img class="img-responsive slide_image" src="../../resources/uploads/{$row['slide_image']}" alt=""></a>	
</a>
</div>

            
DELIMITER;
echo $slides;
}

}
?>
