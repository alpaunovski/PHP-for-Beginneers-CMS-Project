<?php include "includes/admin_header.php" ?>
<!-- This page is responsible for managing all posts in the Admin area. It can edit, delete, view, clone or make new posts -->


    <div id="wrapper">

        <!-- Navigation -->
       
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Add Category Form -->
                <div class="row">
                    <div class="col-lg-12">
                        
                    <h1 class="page-header">
                            Welcome to Admin Panel
                            <small>Author</small>
                    </h1>
                         <?php 
                        //Depending on the source attribute, we do different things with the posts. Add, edit, or view all posts.
                            if(isset($_GET['source'])){

                                $source = escape($_GET['source']);

                                

                            } else {
                                $source = '';
                            }

                            switch($source){
                                case 'add_post';
                                include "includes/add_post.php";                               
                                break;

                                case 'edit_post';
                                include "includes/edit_post.php";                               
                                break;

                                default: 
                                include "includes/view_all_posts.php";


                            }



                        ?>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Admin footer -->
<?php include "includes/admin_footer.php" ?>
