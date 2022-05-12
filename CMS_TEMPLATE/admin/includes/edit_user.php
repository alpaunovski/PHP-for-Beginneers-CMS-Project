<?php 

if(isset($_GET["edit_user"])){

$the_user_id = escape($_GET["edit_user"]);

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

if(isset($_POST['edit_user'])){
    // $user_id = $_POST["user_id"];
    $user_firstname = escape($_POST["user_firstname"]);
    $user_lastname = escape($_POST["user_lastname"]);
    $user_role = escape($_POST["user_role"]);

    // $post_image = $_FILES["image"]["name"];
    // $post_image_temp = $_FILES["image"]["tmp_name"];

    $username = escape($_POST["username"]);
    $user_email = escape($_POST["user_email"]);
    $user_password = escape($_POST["user_password"]);
    // $post_date = date("d-m-y");
    // $post_comment_count = 4;


    if(!empty($user_password)) {
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $get_user_query = mysqli_query($connection, $query_password);
        
        confirm($get_user_query);
        
        $row = mysqli_fetch_array($get_user_query);

        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password) {
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }

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

        echo "User Updated" . "<a href='users.php'>View Users</a>";

    }
 
    
    
 
}

} else {
    header("Location: index.php");
}

?>

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
<input autocomplete="off" type="password" class="form-control" name="user_password">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
</div>
</form>