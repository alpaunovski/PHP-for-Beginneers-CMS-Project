<?php  include "includes/db.php"; ?>
<?php //Header.php already includes functions.php ?>
<?php  include "includes/header.php"; ?>

 <?php 
 //Submit button 
 if(isset($_POST['submit'])) {

    $username = escape(trim($_POST['username']));
    $email = escape(trim($_POST['email']));
    $password = escape(trim($_POST['password']));

    //Array of errors
    $error = [

        'username' => '',
        'email' => '',
        'password' => ''



    ];

    //Checking if username, email or password are empty or of required length. Populate the Error array if necessary.
    if(strlen($username) < 4){
        $error['username'] = 'Username needs to be longer';
    }

    if($username == ''){
        $error['username'] = 'Username cannot be empty';
    }

    if (username_exists($username)) {
        $error['username'] = 'Username already exists';
    }

    if($email == ''){
        $error['email'] = 'Email cannot be empty';
    }

    if (email_exists($email)) {
        $error['email'] = 'Email already exists, <a href="index.php">Log in</a>';
    }

    if($password == '') {
        $error['password'] = 'Password cannot be empty';
    }

    //Registering the user. We check the Error array for errors.
    foreach($error as $key => $value) {

        //If Errors array is empty, we proceed to register the user.
        if(empty($value)){
            register_user($username, $email, $password);

            //We login the user here
            login_user($username, $password);
        }
    }

}
 
 
 ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">

                <h6 class="text-center">

                <?php echo $message; ?>

                </h6>
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
