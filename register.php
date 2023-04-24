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
<div class='pt-1'>
<label for='username'>Username: </label>
<input type='text' id='uname' name='uname'>
</div>
<br>
<div class='pt-1'>
<label for='password'>Password: </label>
<input type='password' id='passwd' name='passwd'>
</div>
<br>
<div class='pt-1'>
<input type='submit' value='Submit'>
</div>
</form>
<a class='nav-link active text-info pt-1' href="login.php">Back to Login</a>
</div>

<?php
printHTMLFooter();	
?>
