<?php include "includes/admin_header.php" ?>


<?php 
//Get the username from the session
if(isset($_SESSION['username'])){
    
    $username = $_SESSION['username'];
    //Select the user from the users table query
    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);
    //Fetch the user details as an array
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

<?php 

//If the POST variable edit user is set, we make a query to update the user in the database
if(isset($_POST['edit_user'])){
    
    //POST values
    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    $username = $_POST["username"];
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];

    //UPDATE query
    $query = "UPDATE users SET ";
    $query .="user_firstname = '{$user_firstname}', ";
    $query .="user_lastname = '{$user_lastname}', ";
    $query .="username = '{$username}', ";
    $query .="user_email = '{$user_email}', ";
    $query .="user_password = '{$user_password}' ";
    $query .= "WHERE username = '{$username}' ";

    $edit_user_query=mysqli_query($connection, $query);
    //Function to confirm the query is successful
    confirm($edit_user_query);
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

                    <!-- user first name -->
<div class="form-group">
    <label for="post_author">First Name</label>
    <input type="text" class="form-control" value="<?php echo $user_firstname ?>" name="user_firstname">
</div>
<!-- User last name -->
<div class="form-group">
    <label for="post_status">Last Name</label>
    <input type="text" class="form-control" value="<?php echo $user_lastname ?>" name="user_lastname">
</div>

<!-- Username -->
<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
</div>

<!-- Email -->
<div class="form-group">
    <label for="post_content">Email</label>
<input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
</div>
<!-- Password -->
<div class="form-group">
    <label for="post_content">Password</label>
<input autocomplete="off" type="password" class="form-control" name="user_password">
</div>
<!-- Submit button -->
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

    <!-- Admin footer -->
<?php include "includes/admin_footer.php" ?>
