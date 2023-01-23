<?php
require_once("utils.php");
printHTMLHeader();
if(isset($_POST['uname']) and isset($_POST['passwd'])){
	$user = $_POST['uname'];
	error_log("creating user $user");
	createNewUser($_POST['uname'], $_POST['passwd']);
	header("Location: http://localhost:8000/login.php");
}
?>

<br>
<p>Please enter your desired username and password</p>
<br>
<form action='register.php' method='post'>
<label for='username'>Username: </label>
<input type='text' id='uname' name='uname'>
<label for='password'>Password: </label>
<input type='password' id='passwd' name='passwd'>
<input type='submit' value='Submit'>
</form>

<?php
printHTMLFooter();	
?>
