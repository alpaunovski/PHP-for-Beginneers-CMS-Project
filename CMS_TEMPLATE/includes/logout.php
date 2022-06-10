<?php session_start(); ?>
<!-- Logout functionality. We null the user session and redirect them to the index page. -->
<?php 

{

    $_SESSION['username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['user_role'] = null;

    header("Location: ../index.php");
}

?>