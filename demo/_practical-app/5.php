<?php include "functions.php"; ?>
<?php include "includes/header.php";?>
	<section class="content">

		<aside class="col-xs-4">
		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

	
	<?php 


/*  Step1: Use a pre-built math function here and echo it


	Step 2:  Use a pre-built string function here and echo it


	Step 3:  Use a pre-built Array function here and echo it

 */

	echo pow(2, 7) . "<br>";

	$string = "This is a string";

	echo strtoupper($string) . "<br>";

	$list = [213, 123, 23, 2342, 555];

	echo max($list);

?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php"; ?>