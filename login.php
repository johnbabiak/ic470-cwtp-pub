<?php
require_once("utils.php");
printHTMLHeader();

if(is_logged_in()) {
	header("Location: http://localhost:8000/index.php");
}

if(isset($_POST['uname'])) {
	login($_POST['uname'], $_POST['passwd']);
}
?>

<h1>Welcome to the Cyber Warefare Training Platform! Please Log In to Continue</h1>

<form action='login.php' method='post'>
<label for='username'>Username: </label>
<input type='text' id='uname' name='uname'>
<label for='password'>Password: </label>
<input type='password' id='passwd' name='passwd'>
<input type='submit' value='Submit'>
</form>
<br>
<a href="register.php">Register</a>

<?php
printHTMLFooter();	
?>
