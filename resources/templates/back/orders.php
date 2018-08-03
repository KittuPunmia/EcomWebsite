<?php require_once("../../resources/config.php"); ?>

    <div class="col-md-12">
            <div class="row">
            <h1 class="page-header">
               All Orders

            </h1>
            </div>

            <div class="row">
            <table class="table table-hover">
                <thead>

                  <tr>
                       <th>ORDER_ID</th>
                       <th>TRANSACTION AMOUNT</th>
                       <th>CURRENCY</th>
                       <th>TRANSACTION STATUS</th>
                       <th>Order Date</th>
                  </tr>
                </thead>
                <tbody>
                    <?php get_orders(); ?>

                </tbody>
            </table>
            </div>

     </div>
            <!-- /.container-fluid -->

        
    <!-- /#wrapper -->
