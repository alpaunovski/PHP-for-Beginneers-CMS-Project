<?php include "includes/admin_header.php" ?>
<?php include "includes/functions.php" ?>

<?php 

if(isset($_SESSION['username'])){
    
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)){

        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_password = $row["user_password"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];

    }
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
                         
                    <form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="post_author">First Name</label>
    <input type="text" class="form-control" value="<?php echo $user_firstname ?>" name="user_firstname">
</div>

<div class="form-group">
    <label for="post_status">Last Name</label>
    <input type="text" class="form-control" value="<?php echo $user_lastname ?>" name="user_lastname">
</div>


<div class="form-group">
    <!-- <label for="post_category_id">Post Category ID</label> -->
    <!-- <input value="<?php echo $post_category; ?>" type="text" class="form-control" name="post_category_id"> -->

    <select name="user_role" id="user_role">
    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

    <?php 
        if($user_role == 'admin'){
           echo " <option value='subscriber'>subscriber</option>";
        } else {
            echo "<option value='admin'>admin</option>";
        }


    ?>
    
    
    

    <?php 
    
    // $query = "SELECT * FROM users ";
    //                                     $select_users = mysqli_query($connection, $query);

    //                                     // confirm($select_users);
                            
    //                                     while ($row = mysqli_fetch_assoc($select_users)){
    //                                         $user_id = $row["user_id"];
    //                                         $user_role = $row["user_role"];
    //                                         echo "<tr>";

    //                                         echo "<option value='$user_id'>{$user_role}</option>";

    //                                         }

    ?>

    </select>
</div>



<!-- <div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" class="form-control" name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
<input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
</div>

<div class="form-group">
    <label for="post_content">Password</label>
<input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
</div>
</form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include "includes/admin_footer.php" ?>
