<?php
	session_start();
	$cwtpDB = __DIR__ . '/cwtp.db';
	function printHTMLHeader() {
		echo "<!DOCTYPE html>\n";
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>CWTP</title>\n";
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
		global $cwtpDB;	
		$db = new SQLite3($cwtpDB);
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select password from users where uname = ?");
			$stm->bindParam(1, $username);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
			if (is_array($row)){
				if($row[0] == hash("sha256", $password)){
					$_SESSION['user'] = $username;
					error_log("current user is '$username'");
					$URL = getSavedURL($username);
					header("Location: http://localhost:8000/$URL");
				}
			}
		}
	}

	function logout() {
		error_log("before logout: " . $_SESSION['user']);
		unset($_SESSION['user']);
		error_log("after logout: " . $_SESSION['user']);
	}

	function createNewUser($username, $password) {
		global $cwtpDB;	
		$db = new SQLite3($cwtpDB);
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$hashpass = hash("sha256", $password);
			$db->exec("insert into users (uname, password) values ('$username', '$hashpass')");
   		}
	}

	function getSavedURL($username) {
		global $cwtpDB;	
		$db = new SQLite3($cwtpDB);
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
			else {
				return "index.php";
			}
		}
	}

	function setSavedURL($username) {
		global $cwtpDB;	
		$db = new SQLite3($cwtpDB);
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$url = substr($_SERVER["REQUEST_URI"], 1);
			if(!(strpos($url, "logout") !== false)) {
				$query = "update users set curURL = '$url' where uname = '$username'";
				$db->exec($query);
			}
		}
	}

	function setChallengeProgress($cname, $progress) {
		global $cwtpDB;
		$uname = $_SESSION['user'];
		$data = json_encode($progress);
		$db = new SQLite3($cwtpDB);
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select progress from challenges where cname = ? and uname = ?");
			$stm->bindParam(1, $cname);
			$stm->bindParam(2, $uname);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
			if (empty($row)){
					$db->exec("insert into challenges (cname, uname, complete) values ('$cname', '$uname', 0)");
			}
			$db->exec("update challenges set progress = '$data' where cname = '$cname' and uname = '$uname'");
		}
	}

	function getChallengeProgress($cname) {
		global $cwtpDB;
		$uname = $_SESSION['user'];
		$db = new SQLite3($cwtpDB);
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select progress from challenges where cname = ? and uname = ?");
			$stm->bindParam(1, $cname);
			$stm->bindParam(2, $uname);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
			if (is_array($row)){
					return json_decode($row[0], true);
			}
			else { return ""; }
		}
	}

	function setChallengeCompletion($cname, $complete) {
		global $cwtpDB;	
		$db = new SQLite3($cwtpDB);
		$uname = $_SESSION['user'];
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select progress from challenges where cname = ? and uname = ?");
			$stm->bindParam(1, $cname);
			$stm->bindParam(2, $uname);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
		$uname = $_SESSION['user'];
			if (empty($row)){
					$db->exec("insert into challenges (cname, uname, complete) values ('$cname', '$uname', $complete)");
			}
			$db->exec("update challenges set complete  = $complete where cname = '$cname' and uname = '$uname'");
		}
	}

	function getChallengeCompletion($cname) {
		global $cwtpDB;
		$db = new SQLite3($cwtpDB);
		$uname = $_SESSION['user'];
		error_log("challenge user: $uname");
   		if(!$db){
      		header("Location: http://localhost:8000/login.php");
		} else {
			$stm = $db->prepare("select complete from challenges where cname = ? and uname = ?");
			$stm->bindParam(1, $cname);
			$stm->bindParam(2, $uname);
			$res = $stm->execute();
			$row = $res->fetchArray(SQLITE3_NUM);
			if (is_array($row)){
					return $row[0];
			}
			else { return 0; }
		}
	}

	if(!is_logged_in() and $_SERVER["REQUEST_URI"] != "/login.php" and $_SERVER["REQUEST_URI"] != "/register.php") {
		header("Location: http://localhost:8000/login.php");
	}
	else {
		if(isset($_SESSION['user'])) {
			setSavedURL($_SESSION['user']);
		}
	}
?>
