
<!-- Include database connection and header file -->
<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->

<?php include "includes/navigation.php" ?>

<?php 

//Liking system

//Checking for the AJAX POST request

if(isset($_POST['liked'])){

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

//1. Select Post

$query = "SELECT * FROM posts WHERE post_id=$post_id";

$postResult = mysqli_query($connection, $query);

$post = mysqli_fetch_array($postResult);
$likes = $post['likes'];

//2. Update the post with likes Incrementing Likes


mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id=$post_id");



//3. Create likes for post

mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES ($user_id, $post_id) ");

exit();

}

//Unliking System

if(isset($_POST['unliked'])){

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

//1. Select Post

$query = "SELECT * FROM posts WHERE post_id=$post_id";

$postResult = mysqli_query($connection, $query);

$post = mysqli_fetch_array($postResult);
$likes = $post['likes'];

//2. Delete likes

mysqli_query($connection, "DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id ");



//3. Update the post with decrementing likes


mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id=$post_id");



//3. Create likes for post

// mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES ($user_id, $post_id) ");

exit();

}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 

            //This is the View counter

            //If we supply a post id, display the post. Else, return the user to index.php
            if(isset($_GET["p_id"])){
                $the_post_id = escape($_GET["p_id"]);
            if($_SERVER['REQUEST_METHOD'] !== 'POST'){
                $view_query = "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $the_post_id ";

                $send_query = mysqli_query($connection, $view_query);

                //Checking for errors
                
                if(!$send_query) {
                    die("Query failed " . mysqli_error($connection));
                }

            }

            //Displaying only published posts to users, OR all posts to Admin user
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";

            } else {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published' ";

            }


            //Making the posts query
                $select_all_posts_query = mysqli_query($connection, $query);

                //Check if there are posts in the database.

                //If not, inform the user there aren't any posts available.
                if(mysqli_num_rows($select_all_posts_query) < 1){

                    echo "<h1 class='text-center' >No categories available</h1>";

                //Else, display the list of posts.
                } else {
                
                    //Fetching posts data in an associative array
                while ($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row["post_title"];
                    $post_author = $row["post_author"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = $row["post_content"];
            ?>
                    <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <!-- We have our own Image Placeholder function -->
                <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>" alt="">                <hr>
                <p><?php echo $post_content ?></p>


                <hr>

                <!-- Liking and Unliking System -->
                <div class="row">
                    <p class="pull-right">
                        <!-- This is targeted by the JavaScript at the end of the file -->
                        <a class="like" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>Like</a>
                    </p>

                </div>

                <div class="row">
                <p class="pull-right">
                        <!-- This is targeted by the JavaScript at the end of the file -->
                        <a class="unlike" href="#"><span class="glyphicon glyphicon-thumbs-down"></span>Unlike </a>
                    </p>
                </div>

                <div class="row">
                    <p class="pull-right">
                        Likes: 10
                    </p>
                </div>

                <div class="clearfix"></div>

            <?php }  
        
        

                    
            ?>



                <!-- Blog Comments -->

                <?php 

                //Checking for POST. Escaping everything before sending it to the DB.
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if(isset($_POST["create_comment"])){
                    $the_post_id = escape($_GET["p_id"]);

                    //Making the query
                   $comment_author = escape($_POST["comment_author"]);
                   $comment_email = escape($_POST["comment_email"]);
                   $comment_content = escape($_POST["comment_content"]);

                   //Checking if all fields have been filled by the user

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() ) ";
     
                        $create_comment_query = mysqli_query($connection, $query);
     
                        //Checking for query errors
                        if(!$create_comment_query){
                         die("QUERY FAILED" . mysqli_error($connection));
                        }
     

                    } else {
                        //If fields empty, return an error to the user
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                    

                   
                } //End of if isset check

                //Clear the comment form and redirect the user back to the same post.
                header("Location: /cms/post.php?p_id=$the_post_id");
            } //End of POST method check

                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <input type="hidden" value="<?php isset($the_post_id) ?? null ?>" >
                    <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Name:</label>
                        <input type="text" class="form-control" name="comment_author">                        
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email:</label>
                        <input type="email" class="form-control" name="comment_email">                        
                    </div>
                        <div class="form-group">
                            <label for="comment_content">Your Comment:</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


                <?php

                //Fetch the approved comments

                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);

                //Check for query errors
                if(!$select_comment_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                //Retrieve comment fields
                while($row = mysqli_fetch_array($select_comment_query)){
                    $comment_date = $row["comment_date"];
                    $comment_content = $row["comment_content"];
                    $comment_author = $row["comment_author"];
                

                ?>


                              <!-- Individual Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <!-- Display comment author -->
                        <h4 class="media-heading"><?php echo $comment_author ?>
                        <!-- Display comment date -->
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <!-- Display comment content -->
                        <?php echo $comment_content ?>
                    </div>
                </div>



                <?php

                    } //Close While Loop for retriving comment data
                           } //Display list of posts if there are posts. Way up there.

                             } // Close the Display Individual Post

                             // Redirect to index if no "p_id" supplied
                              else {

                        header("Location: index.php");
                    }
                        

                ?>

      

                
               
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

            </div>
        <!-- /.row -->

        <hr>


        <!-- Include the footer -->
<?php include "includes/footer.php" ?>


<!-- Likes script -->
<script>

$(document).ready(function(){

    // Get the post id from PHP
    var post_id = <?php echo $the_post_id ?>;

    //Hardcoded user id. This id belongs to admin user rico.
    var user_id = 41;

    //Liking
    $('.like').click(function(){
$.ajax({
    url: "/cms/post.php?p_id=<?php echo $the_post_id ?>",
    type: 'post',
    data: {
        'liked': 1,
        'post_id': post_id,
        'user_id': user_id
    }
});    

});

//Unliking
$('.unlike').click(function(){
$.ajax({
    url: "/cms/post.php?p_id=<?php echo $the_post_id ?>",
    type: 'post',
    data: {
        'unliked': 1,
        'post_id': post_id,
        'user_id': user_id
    }
});    

});

});
</script>
