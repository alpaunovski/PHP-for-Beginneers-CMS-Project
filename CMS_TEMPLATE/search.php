
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

                //Search button submission
                        
                if(isset($_POST["submit"])){
                    $search = escape($_POST["search"]);
                    //Searching the database query
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";

                    $search_query = mysqli_query($connection, $query);

                    if(!$search_query){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    //If no rows match, we tell them no results
                    $count = mysqli_num_rows($search_query);

                    if($count == 0){
                        echo "<h1> No result </h1>";
                    } else {
                        
                        //Else we display the results as posts
                        while ($row = mysqli_fetch_assoc($search_query)){
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

                        <!-- The post author -->
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <!-- The post image -->
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <!-- The post content -->
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
        
                    <?php } 

                    }
                } ?>





               



               
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

            </div>
        <!-- /.row -->

        <hr>


<?php include "includes/footer.php" ?>
