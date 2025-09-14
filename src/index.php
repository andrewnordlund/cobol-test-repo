<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/cobollib.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
 		<link href="styles/cobolTest.css" rel="Stylesheet" type="text/css">
        <title>Hello World in COBOL</title>
		<meta content="width=device-width,initial-scale=1" name="viewport">
		<style>
		</style>
	</head>
	<body>
		<main>
			<h1>Hello World in COBOL</h1>
  <?php
        print "\t\t\t<p>This page should work.</p>\n";
		execCBL("./hello_world");

  ?>
			</div>
			<div>
				<p>Check out the demo of <a href="interactive.php">Interactive COBOL</a>.
		        <p>That's all, folks!</p>
			</div>
		</main>
	 </body>
</html>

<?php

function execCBL ($prog) {
        $retCode = null;
        $output = null;
        exec($prog, $output, $retCode);
		print "<p>Result:</p>\n<div class=\"results\">";
        for ($i = 0; $i < count($output); $i++) {
                print $output[$i] . "<br>\n";
        }
		print "</div>\n";
} // End of execCBL

?>


