<?php 
//This file is responsible for editing a post.

//Get the post id from the url
if(isset($_GET["p_id"])){
   $the_post_id = $p_id = escape($_GET["p_id"]);
}
//Select the post from the database
$query = "SELECT * FROM posts WHERE post_id=$the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);
//Fetch an associative array from the query
while ($row = mysqli_fetch_assoc($select_posts_by_id)){
    //Assign the different fields to variables
    $post_id = $row["post_id"];
    $post_user=$row["post_user"];
    $post_category = $row["post_category_id"];
    $post_status = $row["post_status"];
    $post_title = $row["post_title"];
    $post_image = $row["post_image"];
    $post_tags = $row["post_tags"];
    $post_comment_count = $row["post_comment_count"];
    $post_date = $row["post_date"];
    $post_content = $row["post_content"];

}
//If the submit button is pressed, assign the fields of the form to variables and create a query.
if(isset($_POST["update_post"])){
    $post_user= escape($_POST["post_user"]);
    $post_title= escape($_POST["title"]);
    $post_category_id= escape($_POST["post_category"]);
    $post_status= escape($_POST["post_status"]);
    $post_image= escape($_FILES["image"]["name"]);
    $post_image_temp= escape($_FILES["image"]["tmp_name"]);
    $post_content= escape($_POST["post_content"]);
    $post_tags= escape($_POST["post_tags"]);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    //Select the old post image, if we have not uploaded a new one.
    if(empty($post_image)){
        $query="SELECT * FROM posts WHERE post_id=$the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }
    //Query to update the post in the database.
    $query = "UPDATE posts SET ";
    $query .="post_title = '{$post_title}', ";
    $query .="post_category_id = '{$post_category_id}', ";
    $query .="post_date = now(), ";
    $query .="post_user = '{$post_user}', ";
    $query .="post_status = '{$post_status}', ";
    $query .="post_tags = '{$post_tags}', ";
    $query .="post_content = '{$post_content}', ";
    $query .="post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id}";

    $update_post=mysqli_query($connection, $query);

    //Display a message that the post has been successfully updated with links to View Posts or Edit Post.
    echo "<p class='bg-success'>Post updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit Another Post</a></p>";
}

?>
<!-- The form to edit the post's properties -->
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
</div>

<div class="form-group">
<label for="post_category">Category</label>

    <select name="post_category" id="post_category">

    <?php 
    
    $query = "SELECT * FROM categories ";
                                        $select_categories = mysqli_query($connection, $query);
                            
                                        while ($row = mysqli_fetch_assoc($select_categories)){
                                            $cat_id = $row["cat_id"];
                                            $cat_title = $row["cat_title"];
                                            echo "<tr>";

                                            echo "<option value='$cat_id'>$cat_title</option>";

                                            }

    ?>

    </select>
</div>

<div class="form-group">
    <!-- Dropdown to select the post user -->
    <label for="post_user">Users</label>
    <select name="post_user" id="post_user">
    <?php echo "<option value='$post_user'>$post_user</option>"; ?>

    <?php 
    
    $query = "SELECT * FROM users ";
    $select_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row["user_id"];
        $username = $row["username"];
        echo "<tr>";

        echo "<option value='$username'>$username</option>";

        }

    ?>

    </select>
</div>
<!-- Dropdown to select the post status -->
<div class="form-group">
    <select name="post_status" id="">
        <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

        <?php if ($post_status == 'published') {
            echo "<option value='draft'>Draft</option>";
        } else {
            echo "<option value='published'>Published</option>";
        } ?>
    </select>
</div>


<div class="form-group">
    <label for="image">Post Image</label>
    <img width="100px" src="../images/<?php echo $post_image ?>" >
    <input type="file" name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea class="form-control" id="summernote" cols="30" rows="10" name="post_content"><?php echo $post_content; ?></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>
</form>