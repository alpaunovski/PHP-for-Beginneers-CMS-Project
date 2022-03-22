<?php include "functions.php"; ?>
<?php include "includes/header.php";?>

	<section class="content">

	<aside class="col-xs-4">

	<?php Navigation();?>
			
	</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

<?php  

/*  Step1: Make an if Statement with elseif and else to finally display string saying, I love PHP



	Step 2: Make a forloop  that displays 10 numbers


	Step 3 : Make a switch Statement that test againts one condition with 5 cases

 */


if (4 > 10){
	echo "4 is less than 10";
} elseif (4 === 10) {
	echo "4 is equal to 10";
} else {
	echo "I love PHP <br>";
}

for ($i = 0; $i <= 10; $i++ ) {
	echo $i . " ";
}


$test = 4;

switch ($test) {
	case 1: 
		echo "it is 1";
	break;
	case 2: 
		echo "it is 2";
	break;
	case 3:
		echo "it is 3";
	break;
	case 4:
		echo "<br> it is 4";
	break;
	case 5:
		echo "it is 5";
	break;

	default: "I don't know";
	break;
}


?>






</article><!--MAIN CONTENT-->
	
<?php include "includes/footer.php"; ?>