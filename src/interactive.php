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
		<main>
			<h1>Interactive COBOL</h1>
  <?php
        print "<p>This page should work.</p>\n";

		if ($age) {
			execCBL("./coboltut3", $age);
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
	        	<p>That's all, folks!</p>
			</div>
		</main>
		<footer>
				<p>Go back to the <a href="index.php">Hello World demo page</a>.
				<p>See the <a href="https://github.com/andrewnordlund/cobol-test-repo">GitHub Repo</a>.</p>
		</footer>
	 </body>
</html>

<?php

function execCBL($prog, $age) {
    list($out, $rc) = runWithExpect(
        "./coboltut3",
        [
            '/Enter Age:/' => $age,
            '/or X to Exit/' => "X",
        ]
    );
    $out = preg_replace("/Enter Age:/", "Enter Age: $age\n", $out);
    $out = preg_replace("/Enter Single Number or X to Exit:/", "", $out);
    echo "<p>Result:</p><div class=\"results\"><pre>" . htmlspecialchars($out) . "</pre></div>\n";
}

function runWithExpect($cmd, $interactions) {
    $descriptorspec = [
        0 => ["pipe", "r"], // stdin
        1 => ["pipe", "w"], // stdout
        2 => ["pipe", "w"], // stderr
    ];

    // Wrap command to disable output buffering
	// On a Mac you may need to run: sudo port install coreutils to get stdbuf

	$stdbuf = "stdbuf";
	if (PHP_OS_FAMILY === 'Darwin') {
		$stdbuf = "/opt/local/bin/gstdbuf"; // MacPorts or Homebrew
	}
	$wrappedCmd = "$stdbuf -o0 -e0 " . $cmd;


    $proc = proc_open($wrappedCmd, $descriptorspec, $pipes);

    if (!is_resource($proc)) {
        throw new RuntimeException("Failed to start process: $cmd");
    }

    // Make pipes non-blocking
    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);

    $output = "";
    $buffer = "";

    while (true) {
        $read = [$pipes[1], $pipes[2]];
        $write = null;
        $except = null;

        if (stream_select($read, $write, $except, 0, 200000)) { // 200ms timeout
            foreach ($read as $r) {
                $chunk = fread($r, 1024);
                if ($chunk !== false && $chunk !== "") {
                    $output .= $chunk;
                    $buffer .= $chunk;

                    // Check each interaction pattern
                    foreach ($interactions as $pattern => $reply) {
                        if (preg_match($pattern, $buffer)) {
                            fwrite($pipes[0], $reply . "\n");
                            fflush($pipes[0]);
                            $buffer = ""; // reset to avoid repeated triggers
                        }
                    }
                }
            }
        }

        $status = proc_get_status($proc);
        if (!$status['running']) break;
    }

    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $returnCode = proc_close($proc);

    return [$output, $returnCode];
}
?>
