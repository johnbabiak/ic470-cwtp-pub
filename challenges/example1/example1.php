<?php
require_once("../../utils.php");

$content = "";

$content .= "<h1>Challenge 1</h1>\n";
$content .= "<p> Welcome to the Cyber Warfare Training Platform! </p>\n";
$content .= "<p> In the world of cyber security, the BASH terminal is a common tool of choice. A terminal is a method of input to a computer that only involves entering in text-based commands, and there are no graphics present for a user to click on or interact with. It is one of the most fundamental and basic ways to interact with a computer. The BASH terminal is a specific version of a terminal with defined commands that a user can select from.</p>\n";
$content .= "<p> In the BASH terminal, there are two fundamental commands that are needed in order to traverse the file system of the computer. The file system is the structure of how files are laid out in an operating system. Typically, BASH terminals are associated with Linux operating systems and so we will teach you about the Linux file system. </p>\n";
$content .= "<p> The Linux file system is made up of two components: files and directories. Directories hold files and files hold data. The Linux file system is also hierarchical, meaning is starts at one top level directory and then all other directories are underneath that one. The top level directory in Linux is called the 'root' directory and is named '\'. Below is a picture of what a Linux file system might look like. </p>\n"; 
$content .= "<img src='./fs_example.png'>\n";
$content .= "<p> In order to view what directory you are currently in, you can type the command 'pwd' into the terminal and press enter. In order to view the contents of the directory you are currently in, you can type the command 'ls' into the terminal and press enter. Try entering those commands into the terminal at this link: </p>\n";
$content .= "<a href='../shell/shell.php'>Web Terminal</a>\n";
$content .= "<br><p> Now it's time for a quiz! </p>\n";

$content .= "<form action='./example1.php'>\n";
$content .= "<p> Which of the following commands can you use to view the contents of the directory you are currently in? Assume you are using a Linux operating system. </p>\n";
$content .= "<input type='radio' id='q1' name='q1' value='pwd'>\n";
$content .= "<label for='q1'>pwd</label><br>\n";
$content .= "<input type='radio' id='q1' name='q1' value='dir'>\n";
$content .= "<label for='q1'>dir</label><br>\n";
$content .= "<input type='radio' id='q1' name='q1' value='ls'>\n";
$content .= "<label for='q1'>ls</label><br>\n";
$content .= "<input type='radio' id='q1' name='q1' value='cd'>\n";
$content .= "<label for='q1'>cd</label><br>\n";
$content .= "<input type='submit' value='Submit'>\n";
$content .= "</form>\n";

if(isset($_GET['q1'])) {
	if($_GET['q1'] == "ls") {
		$content .= "<p>That's correct! Use 'ls' to view directory contents.</p>\n";
	}
	else {
		$cmd = $_GET['q1'];
		$content .= "<p>Incorrect! $cmd is not used to view directory contents</p>\n"; 
	}
}

displayContent($content);

?>
