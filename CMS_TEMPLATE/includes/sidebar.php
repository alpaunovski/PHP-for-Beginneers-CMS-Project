<?php 
//The sidebar login form
if(ifItIsMethod('POST')){
    if(isset($_POST['login'])){

    
    if(isset($_POST['username']) && isset($_POST['password'])) {
        login_user($_POST['username'], $_POST['password']);

    } else {
        redirect('/cms/index.php');
    }
}
}


?>

<div class="col-md-4">




                <!-- Blog Search Well -->
                <div class="well">

                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="submit" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form> <!-- search form -->
                    <!-- /.input-group -->
                </div>

                <!-- Login Well -->
                <div class="well">

                <!-- Check if there is a session and the user is logged in -->
                    <?php if(isset($_SESSION['user_role'])): ?>
                        <h4>Logged in as <?php echo $_SESSION['username']; ?> </h4>

                        <!-- Logout button -->
                        <a href='includes/logout.php' class='btn btn-primary'>Logout</a>

                        <!-- If no session then the user needs to log in -->
                    <?php else: ?>
                        <h4>Login</h4>
                    <form method="post">
                    <div class="form-group">
                        <!-- Username field -->
                        <input name="username" type="text" class="form-control" placeholder="Enter username">
                        
                    </div>
                    <!-- Password field -->
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter password">
                        <span class="input-group-btn">
                            <!-- Submit button -->
                        <button class="btn btn-primary" name="login" type="submit">Submit</button>
                    </span>
                        
                    </div>


                    <div class="form-group">
                        <a href="forgot.php?forgot=<?php echo uniqid(true); ?>" class="btn btn-">Forgot Password</a>
                    </div>
                    </form> <!-- login form -->
                    <?php endif; ?>
                    
                    <!-- /.input-group -->
                </div>





                <!-- Blog Categories Well -->
                <div class="well">

                    <?php
                    
                        $query = "SELECT * FROM categories ";
                        $select_all_categories_sidebar = mysqli_query($connection, $query);



                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                            <?php 
                            
                                while ($row = mysqli_fetch_assoc($select_all_categories_sidebar)){
                                    $cat_title = $row["cat_title"];
                                    $cat_id = $row["cat_id"];
        
                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                }
                            
                            ?>
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                    <?php include "widget.php"; ?>

            </div>

