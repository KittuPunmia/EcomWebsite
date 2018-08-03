<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   EDIT Product
      <?php 
      if(isset($_GET['id'])){
        $query=query("SELECT * FROM products WHERE product_id='". escape_string($_GET['id']) ."'");
        confirm($query);
        while($row=fetch_array($query)){
          $product_title=escape_string($row['product_title']);
          $product_description=escape_string($row['product_description']);
        $product_price=escape_string($row['product_prize']);
        $product_category_id=escape_string($row['product_category_id']);
        $short_desc=escape_string($row['short_desc']);
        $product_quantity=escape_string($row['product_quantity']);
        $product_image=display_image(escape_string($row['product_image']));


        }
        }
        ?>
</h1>
</div>
               


<form action="<?php editproduct(); ?>" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>"></input>
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control" ><?php echo $short_desc; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
      </div>
    </div>
<div class="form-group">
           <label for="product-title">Product Short Description</label>
      <textarea name="short_desc" id="" cols="30" rows="3" class="form-control" ><?php echo $short_desc; ?></textarea>
    </div>





    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <!-- <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">-->
     <input type="submit" name="submit" value="submit">
    </div>


     <!-- Product Categories-->
<?php echo $product_category_id; ?>
    <div class="form-group">
         <label for="product-title">Product Category</label>
          <select name="product_category_id" class="form-control">
<option value="<?php echo $product_category_id; ?>"> <?php echo find_category_by_id($product_category_id); ?></option>
<?php show_categories_add_product_page(); ?>
</select>
</div>





    <!-- Product Brands-->

    <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <input name="product_quantity" type="number" class="form-control" value="<?php echo $product_quantity; ?>">
         </div>


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
      <br>
      <img width="150" src="../../resources/<?php echo $product_image; ?>">
    </div>

<h3><?php display_message(); ?></h3>

</aside><!--SIDEBAR-->


    
</form>



                



            </div>
            <!-- /.container-fluid -->

       