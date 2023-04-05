<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<h1>Challenge 3</h1>
<p>Another form of hiding messages is through encryption. Encryption is the process of systematically changing information from one form, typically called plaintext, into another form, typically called a ciphertext. A plaintext can be converted to a ciphertext and vice versa by following an encryption scheme.</p>

<p>For this challenge, we will be using a simple cipher called the Caesar Cipher. You can check it out <a href="../../tools/Caesar Cipher/Caesar Cipher.php">here</a>.</p>

<p>Here is your ciphertext: ZTQM{p1jim3_3kzovmq10k}. Try to convert it back into the plaintext!</p>
<?php
$form = "
<form action='./Example 3.php'>
<p>Submit the flag here:</p>
<input type='text' id='flag-cap' name='flag-cap'>
<input type='submit' value='Submit'>
</form>
";

$completion = getChallengeCompletion("Example 3");
if(!$completion) {
	echo $form;
	if(isset($_GET['flag-cap'])) {
			if($_GET['flag-cap'] == "CWTP{s1mlp3_3ncrypt10n}") {
				echo "<p>That is correct! Nice work.</p>";
				$completion = 1;
				setChallengeCompletion("Example 3", $completion);
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
			<form action='./Example 3.php' method='get'>
			<input type='hidden' name='playAgain' value='y'>
			<input type='submit' value='Play Again'>
			</form>
		 ";
		if(isset($_GET['playAgain'])) {
			setChallengeCompletion("Example 3", 0);
			Header('Location: '.$_SERVER['PHP_SELF']);
		}

}
printHTMLFooter();
?>
