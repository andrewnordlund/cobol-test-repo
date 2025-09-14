<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/cobollib.php");
$age = null;
$age = (isset($_GET['age']) ?  $_GET['age'] : "");
$age = preg_replace("/\D/", "", $age);
if (!preg_match("/\d/", $age)) $age = null;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
 		
        <title>Interactive COBOL</title>
		<meta content="width=device-width,initial-scale=1" name="viewport">
		<link href="styles/cobolTest.css" rel="Stylesheet" type="text/css">
	</head>
	<body>
		<h1>Interactive COBOL</h1>
  <?php
        print "<p>This page should work.</p>\n";

		if ($age) {
			execCBL("./coboltut3 <<< $'$age\nX'");
		}
?>
		<form action="" method="GET">
		<div>
		<label for="age">Enter your age</label>
		<input id="age" name="age" type="text" pattern="\d+">
		</div>
		<div>
			<input type="submit" value="Submit">
		</div>
		</form>
  		<div>
			<p>Go back to the <a href="index.php">Hello World demo page</a>.
	        <p>That's all, folks!</p>
		</div>
	 </body>
</html>

<?php

function execCBL ($prog) {
	global $age;
	$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
   2 => array("pipe", "w")   // stderr 
);
	$proc = proc_open($prog, $descriptorspec, $pipes);
	if (is_resource($proc)) {
		$contents = stream_get_contents($pipes[1]);
		$contents = preg_replace("/Enter Single Number or X to Exit:/", "", $contents);
		$contents = preg_replace("/Enter Age :/", "Enter Age: $age\n", $contents);
		$contents = preg_replace("/\n/", "\n<br>", $contents);
		proc_close($proc);
		print "<div class=\"results\">$contents</div>\n";
	} else {
		print "Not a process.<br>\n";
	}
} // End of execCBL

?>


