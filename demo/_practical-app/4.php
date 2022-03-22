<?php include "functions.php"; ?>
<?php include "includes/header.php";?>

	<section class="content">

	<aside class="col-xs-4">

		<?php Navigation();?>
			
		
	</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

	
	<?php  

/*  Step1: Define a function and make it return a calculation of 2 numbers

	Step 2: Make a function that passes parameters and call it using parameter values


 */

function two_numbers(){
	$num1 = 530;
	$num2 = 430;
	$sum = $num1 + $num2;

	return $sum;
}

$the_sum = two_numbers() . " // Two numbers <br>";

echo $the_sum;

two_numbers();

 function sum_two_numbers($num1, $num2){
	 echo $num1 + $num2 . " // The parameter function <br>";
 }

 sum_two_numbers(64, 46);
	
?>





</article><!--MAIN CONTENT-->


<?php include "includes/footer.php"; ?>