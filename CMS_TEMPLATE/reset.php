<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 

// if(isset($_GET['email']) && !isset($_GET['token'])) {

//     redirect('index');
// }

// $token = $_GET['token'];

$email = 'apaunovski@gmail.com';

$token = '424a50965bbc458063577d0655ae2fd0a5af359087d6a62b6c5bee4ddbb741395276df1b90b9fc4dbbb23e3b1474802d5d43';

if($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token = ?')){
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // if ($_GET['token'] !== $token || $_GET['email'] !== $email) {
    //     redirect('index');
    // }

    if(isset($_POST['password']) && isset($_POST['confirmPassword'])) {

        if($_POST['password'] === $_POST['confirmPassword']){

            $password = $_POST['password'];

            $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='{$hashed_password}' WHERE user_email = ?" )){
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) >= 1){
                    redirect('/cms/login.php');
                } 
            }
        }


    }

}

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <h2>Please check your email</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

