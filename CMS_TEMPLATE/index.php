
<!-- Databse Connection-->
<?php include "includes/db.php" ?>

<!-- Header -->
<?php include "includes/header.php" ?>

    <!-- Navigation -->

<?php include "includes/navigation.php" ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 

            //Five posts per page
            $per_page = "5";

            //If we are getting a page

            if(isset($_GET['page'])){

                

               $page = escape($_GET['page']);
            } else {
                $page="";
            }

            //Pages start from zero
            if ($page =="" || $page == 1){
                $page_1 = 0;
            } else {
                $page_1 = ($page * 5) -5;
            }

            //If user is admin, display all posts, else display only published posts

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                $post_query_count = "SELECT * FROM posts ";

            } else {
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' ";

            }
            //Figure how many posts there are in total
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);

            //If no posts then echo no posts available
            if($count < 1){
                echo "<h1 class='text-center' >No posts available</h1>";
            } else {
            
            //We determine the number of pages. 5 posts per page.
            $count = ceil($count / 5);

                //Pagination system query.

                //We limit which range of posts to display. page_1 is the start of the range and $per_page is the end of the range.
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page ";
                $select_all_posts_query = mysqli_query($connection, $query);

                //Fetch posts fields
                while ($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row["post_id"];
                    $post_title = $row["post_title"];
                    $post_user = $row["post_user"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = substr($row["post_content"], 0,100);
                    $post_status = $row["post_status"];

                    if($post_status == "published" ){
                    
            ?>

            <!-- Page heading and secondary text -->
                    <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <!-- Echo post title -->
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    <!-- Echo the post author. We are echoing the post_user field from the database -->
                    by <a href="author_posts.php?author=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a>
                </p>
                <!-- Echoing the post date -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <!-- This is the post image with a link to the post itself -->
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                </a>
                <hr>
                <!-- This is the post content -->
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php  }}}?>



               
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

            </div>
        <!-- /.row -->

        <hr>

        <!-- The pager itself -->
<ul class="pager">

<?php 

for($i = 1; $i <= $count; $i++){

    //If we are on the same page where the link points, we mark the page as active

    if($i == $page){
        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
    } else {

    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
    }
}

?>



</ul>

<!-- Footer -->
<?php include "includes/footer.php" ?>
