<?php
require_once("../../utils.php");
printHTMLHeader();

$progress = getChallengeProgress("test1");
error_log("progress: " . var_dump($progress));

$progress = ["name" => "john", "fave food" => "pasta"];
setChallengeProgress("test1", $progress);

$complete = getChallengeCompletion("test1");
error_log("completion: $complete");
setChallengeCompletion("test1", 1);
?>


<?php
printHTMLFooter();
?>
