<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

 <?php 

//Language stuff

if(isset($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];

    if(isset($_SESSION['lang']) && $_SESSION['lang'] == $_GET['lang']) {

        echo "<script type='text/javascript'>location.reload();</script>";

    }

    if(isset($_SESSION['lang'])){
        include "includes/languages" . $_SESSION['lang'] . ".php";
    } else {
        include "includes/languages/en.php";
    }

}

 //Submit button 
 if($_SERVER['REQUEST_METHOD'] == "POST") {

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


            unset($error[$key]);
        }
    } //foreach

    if(empty($error)){

        register_user($username, $email, $password);

        login_user($username, $password);


    }
}
 
 
 ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    <form class="navbar-form navbar-right" method="get" action="" id="language_form">
        <div class="form-group">
            <select name="lang" class="form-control" onchange="changeLanguage()" >
                <option value="en">English</option>
                <option value="bg">Bulgarian</option>
            </select>
        </div>
    </form>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">

                <h6 class="text-center">

                

                </h6>
                <!-- Registration Form -->
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <!-- Username field -->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">

                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                        </div>
                        <!-- Email Field -->
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">

                            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div>
                        <!-- Password Field -->
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">

                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                        </div>

                        <!-- Submit button -->
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<script>
    function changeLanguage(){

        document.getElementById('language_form').submit();

    }
</script>

<?php include "includes/footer.php";?>
