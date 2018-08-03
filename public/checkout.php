<?php require_once("../resources/config.php");  ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php"); ?>
    <!-- Page Content -->
    <?php 
if(isset($_SESSION['user'])){
    echo $_SESSION['user'];
}
    ?>
    <div class="container">


<!-- /.row --> 

<div class="row">
<h4 class="text-center bg-danger"><?php display_message(); ?>
</h4>
      <h1>Checkout</h1>
  <form method="post" action="pgRedirect.php">
  
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
             </tbody>
    </table>
    <?php  $order_id="ORDS" . rand(10000,99999999);
    if(isset($_SESSION['user'])){
    $customername=$_SESSION['user'];
    $sql = "SELECT * FROM customers ";
    $sql .= "WHERE user_name='" . escape_string($customername) . "'";
    $query=query($sql);
confirm($query);
    $cust = mysqli_fetch_assoc($query);
        mysqli_free_result($query);


}else
{
  echo "please login to continue";
}


     ?>

  <input id="ORDER_ID" type="hidden" tabindex="1" maxlength="20" size="20"
            name="ORDER_ID" autocomplete="off"
            value=<?php echo $order_id;  ?>>
  <input id="CUST_ID" type="hidden" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value=<?php if(isset($_SESSION['user'])){
       echo $cust['user_id'];
    }else{
       

      } ?>>
  <input id="INDUSTRY_TYPE_ID" type="hidden" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
  <input id="CHANNEL_ID" tabindex="4" type="hidden" maxlength="12"
            size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
     <input title="TXN_AMOUNT" type="hidden" tabindex="10"
            type="text" name="TXN_AMOUNT"
            value="<?php echo $_SESSION['item_total']; ?>">
<input type="hidden" id="item_rows" name="item_rows" value="<?php echo $_SESSION['item_rows']; ?>">
      <input value="CheckOut" type="submit" onclick="">
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php
echo isset($_SESSION['item_count']) ? $_SESSION['item_count'] :$_SESSION['item_count']="0";

?>
</span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">&#8377;
<?php
echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] :$_SESSION['item_total']="0";

?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->
        <!-- Footer -->
       

    </div>
    <!-- /.container -->
<?php require_once(TEMPLATE_FRONT . DS . "footer.php"); ?>
