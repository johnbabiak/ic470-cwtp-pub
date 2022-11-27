<?php

require_once("./utils.php");

$content = "";

$content .= "<h1>Welcome to the Cyber Warfare Training Platform!</h1>";
$content .= "<h2>Below is a listing of challenges that you can work on.<br>Click on any of them to get started!</h2>";
$challenges = array_slice(scandir("./challenges"), 2);
#echo var_dump($challenges);
foreach ($challenges as $cname) {
	$content .= "<a href='./challenges/$cname/$cname.php'>" . $cname . "</a><br>";
}

displayContent($content);

?>
