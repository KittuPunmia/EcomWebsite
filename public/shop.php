<?php require_once("../resources/config.php");  ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header>
        <h1>SHOP</h1>
        </header>

        <hr>

        <!-- Title -->
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php get_category_detail_in_shop();
            ?>
            
            
            
        </div>
        <!-- /.row -->

        
    </div>
    <!-- /.container -->
<?php require_once(TEMPLATE_FRONT . DS . "footer.php"); ?>

