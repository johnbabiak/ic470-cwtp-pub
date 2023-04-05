<?php
	session_start();
	$cwtpDB = __DIR__ . '/cwtp.db';
	function printHTMLHeader($show=True) {
		echo "<!DOCTYPE html>\n";
		echo "<html lang='en'>\n";
		echo "<head>\n";
		echo "	<title>CWTP</title>\n";
		echo "	<meta name='viewport' content='width=device-width, initial-scale=1'>";
		echo "	<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'>";
		echo "</head>\n";
		echo "<body>\n\n";
		if($show == True) {
			showLinks();
		}
		echo "<div class='container-fluid'>\n";
		echo "<div class='row'>\n";
		if($show == True) {
			showSidebar();
		}
		echo "<div class='col'>\n";
	}

	function printHTMLFooter() {
		echo "</div></div>";
		echo "\n\n</body>\n";
		echo "</html>";
	}	

	function displayContent($content) {
		printHTMLHeader();
		echo $content;
		printHTMLFooter();
	}

	function showLinks() {
		echo "<nav class='navbar navbar-dark'>\n";
		echo "<div class='container-fluid text-bg-dark rounded'>\n";
		echo "<div class='navbar-header'>\n";
		echo "<a class='navbar-brand' href='/'>Cyber Warfare Training Platform</a>\n";
		echo "</div>\n";
		echo "<a class='nav-link active' href=../../index.php>Home</a>\n";
		echo "<a class='nav-link active' href=../../tools.php>Tools</a>\n";
		echo "<a class='nav-link active' href=../../logout.php>Logout</a>\n";
		echo "</div>\n";
		echo "</nav>\n";
	}

	function showSidebar() {
		echo "<div class='col-3'>\n";
		echo "<h6>Challenge Progress</h6>\n";
		echo "<ul class='nav nav-pills flex-column mb-auto'>\n";
		$total = 0;
		$complete = 0;

		$challenges = array_slice(scandir(__DIR__ . "/challenges"), 2);
		#echo var_dump($challenges);
		foreach ($challenges as $cname) {
			$status = "text-bg-secondary";
			$total = $total + 1;
			if(getChallengeCompletion($cname)) {
				$status = "text-bg-success";
				$complete = $complete + 1;
			}
				
			echo "<li class='nav-item pt-1'><a class='nav-link active " . $status . "' href='../../../../challenges/$cname/$cname.php'>" . $cname . "</a></li>\n";
		}

		$prog = round(($complete/$total)*100);
		echo "<li class='nav-item pt-1'><div class='progress'><div class='progress-bar progress-bar-striped bg-success' role='progressbar' style='width: " . $prog . "%' aria-valuenow='" . $prog . "' aria-valuemin='0' aria-valuemax='100'></div></div></li>\n";
		echo "</ul>\n";
		echo "</div>\n";
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

	function create_db() {
		global $cwtpDB;	
		$db = new SQLite3($cwtpDB);
   		if(!$db){
      		exec("cat ~/ic470-cwtp-pub/create_table.txt | sqlite3 ~/ic470-cwtp-pub/cwtp.db");
		}
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
