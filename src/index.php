<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/cobollib.php");
?>
<!DOCTYPE html>
<html lang="en">
 <head>
        <title>Hello World 2</title>
 </head>
 <body>
  <h1>Hello World 2</h1>
  <?php
        print "<p>This page should work.</p>\n";
        $retCode = null;
        $output = null;
        exec("./runcobol.sh", $output, $retCode);
        print "<p>Result:<br>\n"; // . var_dump($output) . ", $retCode.</p>\n";
        for ($i = 0; $i < count($output); $i++) {
                print $output[$i] . "<br>\n";
        }

        $retCode = null;
        $output = null;
        exec("./hello_world", $output, $retCode);
		print "Result 2:<br>\n";
        for ($i = 0; $i < count($output); $i++) {
                print $output[$i] . "<br>\n";
        }
  ?>
        <p>That's all, folks!</p>
 </body>
</html>
