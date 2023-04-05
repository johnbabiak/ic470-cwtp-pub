<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<h1> Caesar Cipher Shift Tool </h1>
<p>This tool can be used to apply a Caesar Cipher Shift to a string</p>
<p>The Caesar Cipher is one of the simplest ciphers that can be used to encrypt text. It involves replacing every letter with another letter in the alphabet that is a fixed distance away from the original letter. For example, if the shift amount was 2 and a given letter was 'A', then the letter would be shifted two letters in the alphabet to 'C'</p>
<p>Try out the tool below! Put data below and see what happens!</p>
<form action='Caesar Cipher.php'>
<label for='orig'>Text: </label>
<input type='text' id='orig' name='orig'><br>
<label for='shift'>Shift Amount: </label>
<input type='text' id='shift' name='shift'><br>
<input type='submit' value='Shift'>
</form>

<?php
$upper_alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$lower_alpha = "abcdefghijklmnopqrstuvwxyz";
if(isset($_GET['orig']) and isset($_GET['shift'])){
	$shift = intval($_GET['shift']);
	$orig = $_GET['orig'];
	$out = "";
	foreach(str_split($orig) as $char) {
		$i = ord($char);
		if($i >= 65 and $i <= 90) {
			$out .= $upper_alpha[(($i - 65) + $shift) % 26];
		}
		elseif ($i >= 97 and $i <= 122){
			$out .= $lower_alpha[(($i - 97) + $shift) % 26];
		}
		else {
			$out .= $char;
		}
	}
	echo "<br>Output: " . $out;
}

printHTMLFooter();
?>
