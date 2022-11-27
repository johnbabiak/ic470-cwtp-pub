<?php

require_once("./utils.php");

$content = "";

$content .= "<h2>Here are all the tools you can use to work on the challenges!</h2>";
$challenges = array_slice(scandir("./tools"), 2);
#echo var_dump($challenges);
foreach ($challenges as $cname) {
	$content .= "<a href='./tools/$cname/$cname.php'>" . $cname . "</a><br>";
}

displayContent($content);

?>
