<?php
require_once("../../utils.php");

$content = "";
$content .= "<h1> Base64 Encoding/Decoding Tool</h1>\n";
$content .= "<p>This tool can be used to base64 encode and decode strings and binary data</p>\n";
$content .= "<p>Base64 uses 64 characters to encode any string. Each of these 64 characters is represented with 6 bits. So, in order to encode data, base64 converts the data into binary, then for every 6 bits matches the appropriate character. To decode base64, the opposite process occurs where the bits are turned back into 8-bit bytes. Base64 encodings also will have '=' characters at the end of them in order to make sure that the length of the input data is a multiple of 3.</p>\n";
$content .= "<p>Try out the tool below! Put data in the 'encode' box to encode it and in the 'decode' box to decode it</p>\n";
$content .= "<form action='base64.php'>\n";
$content .= "<input type='text' id='2enc' name='2enc'>\n";
$content .= "<input type='submit' value='Encode'>\n";
$content .=  "</form>\n";

if(isset($_GET['2enc'])){
	$orig = $_GET['2enc'];
	$enc = base64_encode($orig);
	$content .= "<p>'$orig' encoded: $enc</p>\n";
}

$content .= "<form action='base64.php'>\n";
$content .= "<input type='text' id='2dec' name='2dec'>\n";
$content .= "<input type='submit' value='Decode'>\n";
$content .=  "</form>\n";

if(isset($_GET['2dec'])){
	$orig = $_GET['2dec'];
	$dec = base64_decode($orig);
	$content .= "<p>'$orig' decoded: $dec</p>\n";
}

displayContent($content);

?>
