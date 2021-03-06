<!-- This is the view all comments file, containing the Comments Table. It's included by admin/comments.php -->
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
                                //Select all comments query
                                    $query = "SELECT * FROM comments ";
                                    $select_comments = mysqli_query($connection, $query);
                                    //Assign the comments table to an associative array
                                    while ($row = mysqli_fetch_assoc($select_comments)){
                                        //Assign the aray values to variables
                                        $comment_id = $row["comment_id"];
                                        $comment_post_id=$row["comment_post_id"];
                                        $comment_author = $row["comment_author"];
                                        $comment_content = $row["comment_content"];
                                        $comment_email = $row["comment_email"];
                                        $comment_status = $row["comment_status"];
                                        $comment_date = $row["comment_date"];
                                       
                                        //Display the cells of the comment table
                                        echo "<tr>";
                                        echo "<td>{$comment_id}</td>";
                                        echo "<td>{$comment_author}</td>";
                                        
                                        echo "<td>{$comment_content}</td>";
                                        
                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_status}</td>";
                                        

                                        //Display the title of the associated post
                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";

                                        $select_post_id_query = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_post_id_query)){
                                            $post_id = $row["post_id"];
                                            $post_title = $row["post_title"];

                                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                        }

                                        
                                        

                                        //Approve, Unapprove, Edit, Delete buttons
                                        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                                        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                                        echo "<td><a href='comments.php?source=edit_post&p_id='>Edit</a></td>";
                                        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                                        echo "<td>{$comment_date}</td>";


                                        echo "</tr>";
                                        
                                    }

                                ?>
                                
                            </tbody>
                        </table>

                        <?php 
                        

                        //Approve query
                        if(isset($_GET["approve"])){

                            $the_comment_id = escape($_GET["approve"]);

                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id} ";

                            $unapprove_query = mysqli_query($connection, $query);
                            header("Location: comments.php");
                        }


                        //Unapprove query
                        if(isset($_GET["unapprove"])){

                            $the_comment_id = escape($_GET["unapprove"]);

                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id} ";

                            $unapprove_query = mysqli_query($connection, $query);
                            header("Location: comments.php");
                        }


                        //Delete query
                        if(isset($_GET["delete"])){

                            $the_comment_id = escape($_GET["delete"]);

                            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";

                            $delete_query = mysqli_query($connection, $query);
                            header("Location: comments.php");
                        }
                        
                        ?>