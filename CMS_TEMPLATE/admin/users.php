<?php include "includes/admin_header.php" ?>
<!-- This page is responsible for adding, editing or viewing users in the admin panel. -->
<?php 

//Check if user is admin, or redirect them to the Index, if they are not.
if(!is_admin($_SESSION['username'])){
    header("Location: index.php");
}
?>



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
                            // Check the source attribute in the URL. Depending on value, either add, edit or view all users
                            if(isset($_GET['source'])){

                                $source = escape($_GET['source']);

                                

                            } else {
                                $source = '';
                            }

                            switch($source){
                                case 'add_user';
                                include "includes/add_user.php";                               
                                break;

                                case 'edit_user';
                                include "includes/edit_user.php";                               
                                break;

                                default: 
                                include "includes/view_all_users.php";


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
