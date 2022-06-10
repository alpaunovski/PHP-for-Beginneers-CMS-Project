<?php include "includes/admin_header.php" ?>
<!-- This page is responsible for viewing and managing post comments. -->


    <div id="wrapper">

        <!-- Navigation -->
       
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Add Category Form -->
                <div class="row">
                    <div class="col-lg-12">
                        
                    <h1 class="page-header">
                            Welcome to Comments
                            <small>Author</small>
                    </h1>
<!-- Display the comments in a table -->
<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Date</th>
                               </tr>
                            </thead>
                            <tbody>
                                <?php 
                                //Query to get all comments
                                    $query = "SELECT * FROM comments WHERE comment_post_id =". mysqli_real_escape_string($connection, escape($_GET['id'])) . " ";
                                    $select_comments = mysqli_query($connection, $query);
                                    //Get the comment attributes
                                    while ($row = mysqli_fetch_assoc($select_comments)){
                                        
                                        $comment_id = $row["comment_id"];
                                        $comment_post_id=$row["comment_post_id"];
                                        $comment_author = $row["comment_author"];
                                        $comment_content = $row["comment_content"];
                                        $comment_email = $row["comment_email"];
                                        $comment_status = $row["comment_status"];
                                        $comment_date = $row["comment_date"];
                                       
                                        //Display the attributes in the table

                                        echo "<tr>";
                                        echo "<td>{$comment_id}</td>";
                                        echo "<td>{$comment_author}</td>";                                        
                                        echo "<td>{$comment_content}</td>";                                        
                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_status}</td>";
                                        


                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";

                                        $select_post_id_query = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_post_id_query)){
                                            $post_id = $row["post_id"];
                                            $post_title = $row["post_title"];
                                            //Display links to the corresponding posts

                                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                        }

                                        
                                        

                                        //Approve, unapprove, edit and delete comments
                                        echo "<td><a href='post_comments.php?approve=$comment_id&id=".$_GET['id'] . "'>Approve</a></td>";
                                        echo "<td><a href='post_comments.php?unapprove=$comment_id&id=".$_GET['id'] . "'>Unapprove</a></td>";
                                        echo "<td><a href='post_comments.php?source=edit_post&$comment_id&id=".$_GET['id'] . "'='>Edit</a></td>";
                                        echo "<td><a href='post_comments.php?delete=$comment_id&id=".$_GET['id'] . "'>Delete</a></td>";
                                        echo "<td>{$comment_date}</td>";


                                        echo "</tr>";
                                        
                                    }

                                ?>
                                
                            </tbody>
                        </table>

                        <?php 
                        

                        //Approve comments
                        if(isset($_GET["approve"])){

                            $the_comment_id = $_GET["approve"];


                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id} ";

                            $unapprove_query = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=" .$_GET['id']);
                        }


                        //Unapprove comments
                        if(isset($_GET["unapprove"])){

                            $the_comment_id = $_GET["unapprove"];

                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id} ";

                            $unapprove_query = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=" . escape($_GET['id']));
                        }


                        //Delete comments
                        if(isset($_GET["delete"])){

                            $the_comment_id = $_GET["delete"];

                            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";

                            $delete_query = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=" . escape($_GET['id']));
                        }
                        
                        ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Admin footer -->
<?php include "includes/admin_footer.php" ?>