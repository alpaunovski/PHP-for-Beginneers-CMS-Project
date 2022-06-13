<?php 
//Check if edit_user is set in the url
if(isset($_GET["edit_user"])){

$the_user_id = escape($_GET["edit_user"]);
//Select the user from the database query
$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                                    $select_users_query = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($select_users_query)){
                                        
                                        $user_id = $row["user_id"];
                                        $username = $row["username"];
                                        $user_password = $row["user_password"];
                                        $user_firstname = $row["user_firstname"];
                                        $user_lastname = $row["user_lastname"];
                                        $user_email = $row["user_email"];
                                        $user_image = $row["user_image"];
                                        $user_role = $row["user_role"];


}
//Check if the form has been submitted
if(isset($_POST['edit_user'])){
    //Assign the form fields to variables
    $user_firstname = escape($_POST["user_firstname"]);
    $user_lastname = escape($_POST["user_lastname"]);
    $user_role = escape($_POST["user_role"]);
    $username = escape($_POST["username"]);
    $user_email = escape($_POST["user_email"]);
    $user_password = escape($_POST["user_password"]);

    //Check if user password is empty
    if(!empty($user_password)) {
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $get_user_query = mysqli_query($connection, $query_password);
        
        confirm($get_user_query);
        
        $row = mysqli_fetch_array($get_user_query);

        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password) {
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }
        //The query to update the user's details
        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_role = '{$user_role}', ";
        $query .="username = '{$username}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = {$the_user_id} ";
    
        $edit_user_query=mysqli_query($connection, $query);
        confirm($edit_user_query);
        //Display a message that the user has been updated
        echo "User Updated" . "<a href='users.php'>View Users</a>";

    }
 
    
    
 
}

} else {
    //If the form has not been submitted, return to index.php
    header("Location: index.php");
}

?>

<!-- Edit user form -->
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

    <select name="user_role" id="user_role">
    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

    <?php 
        if($user_role == 'admin'){
           echo " <option value='subscriber'>subscriber</option>";
        } else {
            echo "<option value='admin'>admin</option>";
        }


    ?>

    </select>
</div>

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
<input autocomplete="off" type="password" class="form-control" name="user_password">
</div>

<!-- Submit button -->
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
</div>
</form>