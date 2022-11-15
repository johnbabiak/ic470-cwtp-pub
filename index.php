<?php

require_once("./utils.php");

$content = "";

$content .= "Challenges<br><br>\n";
$challenges = array_slice(scandir("./challenges"), 2);
#echo var_dump($challenges);
foreach ($challenges as $cname) {
	$content .= "<a href='./challenges/$cname/$cname.php'>" . $cname . "</a><br>";
}

displayContent($content);

?>
