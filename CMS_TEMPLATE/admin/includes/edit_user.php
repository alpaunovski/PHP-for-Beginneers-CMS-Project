<?php 

if(isset($_GET["edit_user"])){

$the_user_id = $_GET["edit_user"];



}
if(isset($_POST['edit_user'])){
    // $user_id = $_POST["user_id"];
    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    $user_role = $_POST["user_role"];

    // $post_image = $_FILES["image"]["name"];
    // $post_image_temp = $_FILES["image"]["tmp_name"];

    $username = $_POST["username"];
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];
    // $post_date = date("d-m-y");
    // $post_comment_count = 4;

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}' ) ";

    $create_user_query = mysqli_query($connection, $query);
    
    confirm($create_user_query);
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="post_author">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="post_status">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
</div>


<div class="form-group">
    <!-- <label for="post_category_id">Post Category ID</label> -->
    <!-- <input value="<?php echo $post_category; ?>" type="text" class="form-control" name="post_category_id"> -->

    <select name="user_role" id="user_role">
    <option value="subscriber">Select Options</option>
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>

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
    <input type="text" class="form-control" name="username">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
<input type="email" class="form-control" name="user_email">
</div>

<div class="form-group">
    <label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
</div>
</form>