<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Add User
   
   <h3><?php display_message(); ?></h3>
</h1>
</div>
               


<form action="<?php add_user();?>" method="post" enctype="multipart/form-data">


<div class="col-md-6">

    


    




    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

<div class="form-group">
    <label for="product-title">User Name </label>
        <input type="text" name="user_name" class="form-control">
       
    </div>

<div class="form-group">
    <label for="product-title">User Email</label>
        <input type="text" name="user_email" class="form-control">
       
    </div>
<div class="form-group">
    <label for="product-title">User Password</label>
        <input type="text" name="user_password" class="form-control">
       
    </div>


     
    <!-- <div class="form-group">
         <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
     <input type="submit" name="submit" value="Submit">
    </div>

     Product Categories-->
<!--
    <div class="form-group">
         <label for="product-title">Product Category</label>
          <select name="product_category_id"  class="form-control">
<option value="">Category</option>
<?php?>
</select>
</div>

-->



    <!-- Product Brands-->

 <!--   <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <input name="product_quantity" type="number" class="form-control">
         </div>
-->

<!-- Product Tags -->


 <!--   <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div>

    <!- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">

    </div>
      <input type="submit" name="submit" value="ADD USER">

<h3><?php display_message(); ?></h3>

</aside><!--SIDEBAR-->


    
</form>



                



            </div>
            <!-- /.container-fluid -->

       