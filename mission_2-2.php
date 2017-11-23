<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ＰＨＰ基礎</title>
</head>
<body>
<form action="mission_2-2.php" method="post">
    名前<input type="text" name="name">
コメント<input type="text" name="comment"><br>
<input type="submit" value="投稿">
</form>

<?php
	
	$filename = "mission_2-2.txt";
	//echo $filename."<br>\n";
$fp = fopen($filename, 'a');
$lines = file($filename); 
$num = count($lines) + 1; 
$str=$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y/m/d H:i:s")."\n";
if(isset($_POST["name"])){        
fwrite($fp,$str);
}
fclose($fp);

?>

</body>
</html>
