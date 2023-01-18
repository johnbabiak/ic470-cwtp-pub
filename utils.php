<?php
	session_start();
	function printHTMLHeader() {
		echo "<!DOCTYPE html>\n";
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>Page Title</title>\n";
		echo "</head>\n";
		echo "<body>\n\n";
		showLinks();
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

	function showLinks() {
		echo "\n<a href=../../index.php>Challenges</a><br>\n";
		echo "<a href=../../tools.php>Tools</a><br>\n";
		echo "<a href=../../logout.php>Logout</a><br>\n";
	}

	function is_logged_in() {
		return isset($_SESSION['user']);
	}

	function login($username, $password) {
		if(is_logged_in()) {
			header("Location: http://localhost:8000/index.php");
		}

		$_SESSION['user'] = $username;
		header("Location: http://localhost:8000/index.php");
	}

	function logout() {
		unset($_SESSION['user']);
	}

	if(!is_logged_in() and $_SERVER["REQUEST_URI"] != "/login.php") {
		header("Location: http://localhost:8000/login.php");
	}
?>
