
<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->

<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 

            if(isset($_GET["p_id"])){
                $the_post_id = escape($_GET["p_id"]);
                $the_post_author = escape($_GET["author"]);
            }
            //We select all posts from the databse for this author
                $query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' ";
                $select_all_posts_query = mysqli_query($connection, $query);
            //Fetch posts attributes
                while ($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row["post_title"];
                    $post_author = $row["post_user"];
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
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                <hr>

            <?php } ?>



                <!-- Blog Comments -->

                <?php 
                
                //We check if we have a POST method and the create_comment field
                if(isset($_POST["create_comment"])){
                    $the_post_id = escape($_GET["p_id"]);
                    //Comment author, author email and comment content. We escape the contents for MySQL injections.
                   $comment_author = escape($_POST["comment_author"]);
                   $comment_email = escape($_POST["comment_email"]);
                   $comment_content = escape($_POST["comment_content"]);

                   //We check if all fields have been populated

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){

                        //We make the comment query into the database

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() ) ";
     
                        $create_comment_query = mysqli_query($connection, $query);
     
                        if(!$create_comment_query){
                         die("QUERY FAILED" . mysqli_error($connection));
                        }
                        //We update the post comment count
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        $query .= "WHERE post_id = $the_post_id ";
     
                        $update_comment_count = mysqli_query($connection, $query);
                    } else {

                        //We display an error if the fields are empty
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                    

                   
                }

                ?>

                

      

                
               
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

            </div>
        <!-- /.row -->

        <hr>

<!-- Footer -->
<?php include "includes/footer.php" ?>
