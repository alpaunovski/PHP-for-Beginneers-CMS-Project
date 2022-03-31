<?php 

if(isset($_GET["p_id"])){
   $the_post_id = $p_id = $_GET["p_id"];
}

$query = "SELECT * FROM posts WHERE post_id=$the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)){
    
    $post_id = $row["post_id"];
    $post_author=$row["post_author"];
    $post_category = $row["post_category_id"];
    $post_status = $row["post_status"];
    $post_title = $row["post_title"];
    $post_image = $row["post_image"];
    $post_tags = $row["post_tags"];
    $post_comment_count = $row["post_comment_count"];
    $post_date = $row["post_date"];
    $post_content = $row["post_content"];

}

if(isset($_POST["update_post"])){
    $post_author=$_POST["post_author"];
    $post_title=$_POST["post_title"];
    $post_category_id=["post_category"];
    $post_status=$_POST["post_status"];
    $post_image=$_FILES["image"]["name"];
    $post_image_temp=$_FILES["image"]["tmp_name"];
    $post_content=$_POST["post_content"];
    $post_tags=$_POST["post_tags"];
}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
</div>

<div class="form-group">
    <!-- <label for="post_category_id">Post Category ID</label> -->
    <!-- <input value="<?php echo $post_category; ?>" type="text" class="form-control" name="post_category_id"> -->

    <select name="post_category" id="post_category">

    <?php 
    
    $query = "SELECT * FROM categories ";
                                        $select_categories = mysqli_query($connection, $query);

                                        // confirm($select_categories);
                            
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
    <label for="post_author">Post Author</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
</div>

<div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
</div>

<div class="form-group">
    <label for="image">Post Image</label>
    <img width="100px" src="../images/<?php echo $post_image ?>" >
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" id="" cols="30" rows="10" name="post_content"><?php echo $post_content; ?></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>
</form>