<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<h1>Challenge 4</h1>
<p>For this challenge, start by reading about this <a href="../../tools/ASCII/ASCII.php">tool</a>.</p>
<p>Then, try to interpret the following hex bytes as characters: <br> 0x43 0x57 0x54 0x50 0x7B 0x68 0x33 0x78 0x5F 0x63 0x68 0x34 0x72 0x73 0x7D</p>

<?php
$form = "
<form action='./Example 4.php'>
<p>Submit the flag here:</p>
<input type='text' id='flag-cap' name='flag-cap'>
<input type='submit' value='Submit'>
</form>
";

$completion = getChallengeCompletion("Example 4");
if(!$completion) {
	echo $form;
	if(isset($_GET['flag-cap'])) {
			if($_GET['flag-cap'] == "CWTP{h3x_ch4rs}") {
				echo "<p>That is correct! Nice work.</p>";
				$completion = 1;
				setChallengeCompletion("Example 4", $completion);
				Header('Location: '.$_SERVER['PHP_SELF']);
			}
			else {
				echo "<p>That is not the flag, please try again.</p>";
			}
	}
}
else {
	echo "<p>You have found the flag and completed this challenge!</p>";
	echo "
			<form action='./Example 4.php' method='get'>
			<input type='hidden' name='playAgain' value='y'>
			<input type='submit' value='Play Again'>
			</form>
		 ";
		if(isset($_GET['playAgain'])) {
			setChallengeCompletion("Example 4", 0);
			Header('Location: '.$_SERVER['PHP_SELF']);
		}

}
printHTMLFooter();
?>
