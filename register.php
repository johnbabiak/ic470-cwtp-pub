<?php
require_once("utils.php");
printHTMLHeader(False);
if(isset($_POST['uname']) and isset($_POST['passwd'])){
	$user = $_POST['uname'];
	error_log("creating user $user");
	createNewUser($_POST['uname'], $_POST['passwd']);
	header("Location: http://localhost:8000/login.php");
}
?>

<div class='container text-center'>
<br>
<p>Please enter your desired username and password</p>
<br>
<form class='pt-1' action='register.php' method='post'>
<label for='username'>Username: </label>
<input type='text' id='uname' name='uname'>
<br>
<label for='password'>Password: </label>
<input type='password' id='passwd' name='passwd'>
<br>
<input type='submit' value='Submit'>
</form>
<a class='nav-link active text-info pt-1' href="login.php">Back to Login</a>
</div>

<?php
printHTMLFooter();	
?>
