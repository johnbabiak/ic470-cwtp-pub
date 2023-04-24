<?php
require_once("./utils.php");
printHTMLHeader();
?>
<div class='container-fluid'>

<div class='pt-5 text-center'>
<h2>Here are all the tools you can use to work on the challenges!</h2>
</div>

<div class='container pt-4 text-center'>
<ul class='nav nav-pills flex-column'>

<?php
$challenges = array_slice(scandir("./tools"), 2);
#echo var_dump($challenges);
foreach ($challenges as $cname) {
	echo  "<li class='nav-item pt-1'><a class='nav-link active text-bg-dark' href='./tools/$cname/$cname.php'>" . $cname . "</a><br>";
}
?>

</ul>
</div>
</div>

<?php
printHTMLFooter();
?>
