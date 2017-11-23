<?php

$filename='kadai5.txt';
//echo $filename;

$fp=fopen($filename,'w');

fwrite($fp,$_POST["comment"]);

fclose($fp);

?>