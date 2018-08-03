<?php require_once("../resources/config.php");  ?>
<?php require_once(TEMPLATE_FRONT . DS . "header.php"); ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <?php require_once(TEMPLATE_FRONT . DS . "side_nav.php"); ?>
<!--side_nav-->
            
            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <!-- carosel-->
                                <?php require_once(TEMPLATE_FRONT . DS . "slider.php"); ?>

                    </div>

                </div>

                <div class="row">
                <?php get_products(); ?>
                    
                    
                    
                    
                    
                    
            </div>

        </div>

    </div>
    <!-- /.container -->
    <?php require_once(TEMPLATE_FRONT . DS . "footer.php"); ?>
