<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

 <?php 
 
 if(isset($_POST['submit'])) {

$to = "aleksandar@paunovsky.com";
$subject = escape($_POST['subject']);
$body = escape($_POST['body']);
$email = escape($_POST['email']);
$header = "From: " . escape($_POST['email']);

// the message
$msg = "From: ". $email . "\n" . "Message: \n" . $body;

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($to, $subject, $msg, $header);


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

                </h6>
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>

                         <div class="form-group">
                            <label for="body" class="sr-only">Message</label>
                            <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
