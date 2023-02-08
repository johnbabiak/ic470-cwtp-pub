<?php
require_once("../../utils.php");
printHTMLHeader();
?>

<h1>Challenge 1</h1>
<p> Welcome to the Cyber Warfare Training Platform! </p>
<p> In the world of cyber security, the BASH terminal is a common tool of choice. A terminal is a method of input to a computer that only involves entering in text-based commands, and there are no graphics present for a user to click on or interact with. It is one of the most fundamental and basic ways to interact with a computer. The BASH terminal is a specific version of a terminal with defined commands that a user can select from.</p>
<p> In the BASH terminal, there are two fundamental commands that are needed in order to traverse the file system of the computer. The file system is the structure of how files are laid out in an operating system. Typically, BASH terminals are associated with Linux operating systems and so we will teach you about the Linux file system. </p>
<p> The Linux file system is made up of two components: files and directories. Directories hold files and files hold data. The Linux file system is also hierarchical, meaning is starts at one top level directory and then all other directories are underneath that one. The top level directory in Linux is called the 'root' directory and is named '\'. Below is a picture of what a Linux file system might look like. </p> 
<img src='./fs_example.png'>
<p> In order to view what directory you are currently in, you can type the command 'pwd' into the terminal and press enter. In order to view the contents of the directory you are currently in, you can type the command 'ls' into the terminal and press enter. Try entering those commands into the terminal at this link: </p>
<a href='../shell/shell.php'>Web Terminal</a>


<?php
$form = "
<br><p> Now it's time for a quiz! </p>
<form action='./example1.php'>
<p> Which of the following commands can you use to view the contents of the directory you are currently in? Assume you are using a Linux operating system. </p>
<input type='radio' id='q1' name='q1' value='pwd'>
<label for='q1'>pwd</label><br>
<input type='radio' id='q1' name='q1' value='dir'>
<label for='q1'>dir</label><br>
<input type='radio' id='q1' name='q1' value='ls'>
<label for='q1'>ls</label><br>
<input type='radio' id='q1' name='q1' value='cd'>
<label for='q1'>cd</label><br>
<input type='submit' value='Submit'>
</form>
";

$completion = getChallengeCompletion("example1");
if(!$completion) { 
	echo $form; 
	if(isset($_GET['q1'])) {
		if($_GET['q1'] == "ls") {
				echo "<p>That's correct! Use 'ls' to view directory contents.</p>\n";
				$completion = 1;
				setChallengeCompletion("example1", $completion);
		}
		else {
			$cmd = $_GET['q1'];
			echo "<p>Incorrect! $cmd is not used to view directory contents</p>\n";
		}
	}
}
else { echo "<br><br>You have completed this challenge!"; }
$hintForm = "
<form action='./example1.php' method='get'>
<p> Need a hint? </p>
<input type='hidden' name='hintId' value='y'>
<input type='submit' value='Click Here'>
</form>
";
if(!$completion) { echo $hintForm; }

if(isset($_GET["hintId"]) and !$completion) {
	echo "<p>The command you should use is a shortened version of the word 'list'</p>\n";
}

printHTMLFooter();
?>
