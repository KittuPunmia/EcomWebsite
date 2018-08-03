    <div class="col-lg-12">
                      

                        <h1 class="page-header">
                            Users
                         
                        </h1>
                          <p class="bg-success">
                          <?php display_message(); ?>
                        </p>
<!--<div class="col-md-4">
    
    <form action="<?php add_category(); ?>" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input name="cat_title" type="text" class="form-control">
        </div>

        <div class="form-group">
            
            <input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
        </div>      


    </form>


</div>
-->
                        
                        <a href="index.php?add_user" class="btn btn-primary">Add User</a>


                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php show_users_in_admin(); ?>
                                    
                                </tbody>
                            </table> <!--End of Table-->
                        

                        </div>










                        
                    </div>
    












            </div>
            <!-- /.container-fluid -->

        