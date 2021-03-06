<?php 

//This is the Add Post file to be included in admin/posts.php

//Check if the Submit button has been pressed.
if(isset($_POST['create_post'])){
    //Assign the form fields to variables
    $post_title = escape($_POST["title"]);
    $post_user = escape($_POST["post_user"]);
    $post_category_id = escape($_POST["post_category"]);
    $post_status = escape($_POST["post_status"]);

    $post_image = escape($_FILES["image"]["name"]);
    $post_image_temp = escape($_FILES["image"]["tmp_name"]);

    $post_tags = escape($_POST["post_tags"]);
    $post_content = escape($_POST["post_content"]);
    $post_date = date("d-m-y");
    move_uploaded_file($post_image_temp, "../images/$post_image");

    //The Add Post Query
    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', 0, '{$post_status}' ) ";

    $create_post_query = mysqli_query($connection, $query);
    
    confirm($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    //Display a message that the post has been added to the database. There is a link to View All Posts and a link to add another post.
    echo "<p class='bg-success'>Post added. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php?source=add_post'>Add Another Post</a></p>";
}

?>

<!-- The Add Post Form -->
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
</div>

<!-- Category Dropdown -->
<div class="form-group">
    <label for="post_category">Category: </label>

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

<!-- Post users dropdown -->
<div class="form-group">
    
    <label for="post_user">Users</label>
    <select name="post_user" id="post_user">

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



<div class="form-group">

    <select name="post_status">
        <option value="draft">Post Status</option>
        <option value="draft">Draft</option>
        <option value="published">Published</option>

    </select>

</div>



<div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" class="form-control" name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea class="form-control" id="summernote" cols="30" rows="10" name="post_content"></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>
</form>