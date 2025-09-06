<!DOCTYPE html>
<html lang="en">
 <head>
 	<title>Hello World 2</title>
 </head>
 <body>
  <h1>Hello World 2</h1>
  <?php
	print "<p>This page should work.</p>\n"; 
	$output = null;
	exec("./hello_world", $output);
	print "<p>Result: " . $output[0] . ".</p>\n";
  ?>
	<p>That's all, folks!</p>
 </body>
</html>
