<?php
require_once("./utils.php");
printHTMLHeader();
?>
<div class='container-fluid'>

<div class='pt-5 text-center'>
<h1>Welcome to the Cyber Warfare Training Platform!</h1>
</div>

<div class='container pt-4 text-center'>
<h6>Below is a listing of challenges that you can work on.<br>Click on any of them to get started!</h6>
<ul class='nav nav-pills flex-column'>
<?php
$challenges = array_slice(scandir("./challenges"), 2);
#echo var_dump($challenges);
foreach ($challenges as $cname) {
	echo "<li class='nav-item pt-1'><a class='nav-link active text-bg-dark' href='./challenges/$cname/$cname.php'>" . $cname . "</a></li><br>";
}
?>

</ul>
</div>
</div>

<?php
printHTMLFooter();
?>
