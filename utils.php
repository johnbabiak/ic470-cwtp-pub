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
		
		$db = new SQLite3('users.db');
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select password from users where uname = ?");
			$stm->bindParam(1, $username);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
			if (is_array($row)){
				error_log("login: " . $row[0]);
				if($row[0] == hash("sha256", $password)){
					$_SESSION['user'] = $username;
					header("Location: http://localhost:8000/index.php");
				}
			}
		}
	}

	function logout() {
		unset($_SESSION['user']);
	}

	function createNewUser($username, $password) {
		$db = new SQLite3('users.db');
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$hashpass = hash("sha256", $password);
			$db->exec("insert into users (uname, password) values ('$username', '$hashpass')");
   		}
	}

	function getSavedURL($username) {
		$db = new SQLite3('users.db');
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select curURL from users where uname = ?");
			$stm->bindParam(1, $username);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
			if (is_array($row)){
					return $row[0];
			}
		}
	}

	function setSavedURL($username) {
		$db = new SQLite3('users.db');
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$url = $_SERVER["REQUEST_URI"];
			$db->exec("insert into users (curURL) values ('$url')");
		}
	}

	if(!is_logged_in() and $_SERVER["REQUEST_URI"] != "/login.php" and $_SERVER["REQUEST_URI"] != "/register.php") {
		header("Location: http://localhost:8000/login.php");
	}
	else {
		setSavedURL($_SESSION['user']);
	}
?>
