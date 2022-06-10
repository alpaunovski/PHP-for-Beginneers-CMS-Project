<?php include "includes/admin_header.php" ?>
<!-- This page displays all comments -->


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
                            //Check the source attribute in the URL
                            if(isset($_GET['source'])){

                                $source = escape($_GET['source']);

                                

                            } else {
                                $source = '';
                            }
                            //Depending on source value, add post, edit post or view all comments
                            switch($source){
                                case 'add_post';
                                include "includes/add_post.php";                               
                                break;

                                case 'edit_post';
                                include "includes/edit_post.php";                               
                                break;

                                default: 
                                include "includes/view_all_comments.php";


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
