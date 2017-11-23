<form action = "mission_2-2.php" method = "post">　//ファイルの追記
	<input type = "text" name = "text1">
	<input type = "submit">
</form>


<?php
$filename = "kadai7.txt";
//echo $filename;

$fp = fopen($filename, 'a'); 

fwrite($fp, $_POST['text1']."\n"); 

fclose($fp);

?>
