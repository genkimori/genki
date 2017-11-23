<?php
$filename = "kadai6.txt";
//echo $filename;

$lines = file($filename);
//var_dump($lines);

foreach($lines as $line) {
	echo $line."<br>\n";
}

?>
