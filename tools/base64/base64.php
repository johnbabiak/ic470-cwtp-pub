<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<h1> Base64 Encoding/Decoding Tool </h1>
<p>This tool can be used to base64 encode and decode strings and binary data</p>
<p>Base64 uses 64 characters to encode any string. Each of these 64 characters is represented with 6 bits. So, in order to encode data, base64 converts the data into binary, then for every 6 bits matches the appropriate character. To decode base64, the opposite process occurs where the bits are turned back into 8-bit bytes. Base64 encodings also will have '=' characters at the end of them in order to make sure that the length of the input data is a multiple of 3.</p>
<p>Try out the tool below! Put data in the 'encode' box to encode it and in the 'decode' box to decode it</p>
<form action='base64.php'>
<input type='text' id='2enc' name='2enc'>
<input type='submit' value='Encode'>
</form>

<?php
if(isset($_GET['2enc'])){
	$orig = $_GET['2enc'];
	$enc = base64_encode($orig);
	echo "<p>'$orig' encoded: $enc</p>\n";
}
?>

<br><form action='base64.php'>
<input type='text' id='2dec' name='2dec'>
<input type='submit' value='Decode'>
</form>

<?php
if(isset($_GET['2dec'])){
	$orig = $_GET['2dec'];
	$dec = base64_decode($orig);
	echo "<p>'$orig' decoded: $dec</p>\n";
}

printHTMLFooter();
?>
