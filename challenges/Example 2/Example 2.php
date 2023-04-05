<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<h1>Challenge 2</h1>
<p>Now, let's learn a little bit more about how to use this platform with a fun challenge.</p>
<p>I have a secret message that I have encoded. You need to decode that message to figure out the secret and complete the challenge!</p>
<p>This kind of challenge is typically called a "capture the flag" or CTF style challenge. That's because you have to find and submit a flag to complete the challange.</p>
<p>Typically, flags will have a particular format to let you know that you found the right flag. For this challenge, the flag will look like CWTP{...flag...}</p>
<p>Also, as a hint, go check out the <a href='../../tools.php'>tools</a> page and see if there is anything there that can help you!</p>
<p>Here is the encoded message: Q1RXUHtiNDVlXzY0XzNuYzBkMW5nfQ==</p>
<?php
$form = "
<form action='./Example 2.php'>
<p>Submit the flag here:</p>
<input type='text' id='flag-cap' name='flag-cap'>
<input type='submit' value='Submit'>
</form>
";

$completion = getChallengeCompletion("Example 2");
if(!$completion) {
	echo $form;
	if(isset($_GET['flag-cap'])) {
			if($_GET['flag-cap'] == "CTWP{b45e_64_3nc0d1ng}") {
				echo "<p>That is correct! Nice work.</p>";
				$completion = 1;
				setChallengeCompletion("Example 2", $completion);
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
			<form action='./Example 2.php' method='get'>
			<input type='hidden' name='playAgain' value='y'>
			<input type='submit' value='Play Again'>
			</form>
		 ";
		if(isset($_GET['playAgain'])) {
			setChallengeCompletion("Example 2", 0);
			Header('Location: '.$_SERVER['PHP_SELF']);
		}

}
printHTMLFooter();
?>
