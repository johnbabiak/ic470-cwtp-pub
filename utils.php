<?php
	function printHTMLHeader() {
		echo "<!DOCTYPE html>\n";
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>Page Title</title>\n";
		echo "</head>\n";
		echo "<body>\n\n";
	}

	function printHTMLFooter() {
		echo "\n\n</body>\n";
		echo "</html>";
	}	

	function displayContent($content) {
		printHTMLHeader();
		echo $content;
		printHTMLFooter();
	}
?>
