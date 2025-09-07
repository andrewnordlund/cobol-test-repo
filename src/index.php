<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/cobollib.php");
?>
<!DOCTYPE html>
<html lang="en">
 <head>
        <title>Hello World in COBOL</title>
 </head>
 <body>
  <h1>Hello World in COBOL</h1>
  <?php
        print "<p>This page should work.</p>\n";

        $retCode = null;
        $output = null;
        exec("./hello_world", $output, $retCode);
		print "Result :<br>\n";
        for ($i = 0; $i < count($output); $i++) {
                print $output[$i] . "<br>\n";
        }
  ?>
        <p>That's all, folks!</p>
 </body>
</html>
