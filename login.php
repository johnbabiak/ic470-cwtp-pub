<?php
require_once("utils.php");
printHTMLHeader(False);

if(is_logged_in()) {
	header("Location: http://localhost:8000/index.php");
}

if(isset($_POST['uname'])) {
	login($_POST['uname'], $_POST['passwd']);
}
?>

<div class='p-5 text-center'>
<h1>Welcome to the Cyber Warefare Training Platform!</h1>
</div>

<div class='container text-center'>
<h6>Please Log In to Continue</h6>
<form class='pt-1' action='login.php' method='post'>
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
<a class='nav-link active text-info pt-1' href="register.php">Register</a>
</div>
<br>

<?php
printHTMLFooter();	
?>
