<?php
require_once("../../utils.php");
printHTMLHeader();

?>
<h1>ASCII Table</h1>

<p>In a computer, there are no such thing as characters, words, or letters. Everything is just data composed of 1's and 0's. In order to represent characters, people had to come up with a convention to describe all of the possible characters with 1's and 0's. Below is a chart describing what hex and decimal numbers correspond to each character withing a computer.</p>
<img class="img-fluid" src="./ascii.svg">
<p>Worth mentioning is that data must be interpreted within the correct context. For example, if we say that the data 0x70 is a character, then we can interpret it as the letter 'p'. If we say that the same data is now an integer, then we can now interpret it as 112. So, interpreting data is context dependent!</p>

<?php

printHTMLFooter();
?>
