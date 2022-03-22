<?php include "functions.php"; ?>
<?php include "includes/header.php";?>



	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


			<article class="main-content col-xs-8">
			
		
	
	<?php 

	/*  Create a link saying Click Here, and set 
	the link href to pass some parameters and use the GET super global to see it

		Step 2 - Set a cookie that expires in one week

		Step 3 - Start a session and set it to value, any value you want.
	*/
	
	//1. Using Get
	print_r($_GET);

	$id=10;

	//2. Set a cookie that expires in a week

	$name= "SomeName";
	$value= 100;
	$expiration= time() + (60*60*24*7);

	setcookie($name, $value, $expiration);

	if(isset($_COOKIE["SomeName"])){
		echo $_COOKIE["SomeName"];
		echo "<br>";
	}

	//3. Start a session and set its value to anything

	session_start(); 

    $_SESSION['greeting'] = 'Hello Student';

	if(isset($_SESSION['greeting'])){
		echo $_SESSION['greeting'];
		echo "<br>";

	}

	?>
	<!-- Using GET -->
    <a href="9.php?id=<?php echo $id ?>" >Click here</a>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php"; ?>