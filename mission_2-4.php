<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ＰＨＰ基礎</title>
</head>
<body>
<form action="mission_2-4.php" method="post">
    名前<br>
<input type="text" name="name"><br><br>
コメント<br>
<textarea name="comment" cols="40" rows="8"></textarea>
<br>
<input type="submit" value="投稿"><br><br>
削除番号<br>
<input type = "text" name = "number">
<input type="submit" value="削除">
</form>

<?php
	
	$filename = "mission_2-4.txt";
	//echo $filename."<br>\n";
$fp = fopen($filename, 'a');
$lines = file($filename); 
$num = count($lines) + 1; 
$str=$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".date("Y/m/d H:i:s")."\n";

if(isset($_POST["name"]) and !empty($_POST["name"])){        
fwrite($fp,$str);
echo $str."<br>\n";//投稿された物表示
}
fclose($fp);
unset($_POST["name"]);
unset($_POST["comment"]);

echo "削除"."<br>\n";	
if(isset($_POST["number"]) and !empty($_POST["number"])){
	$contents =file('mission_2-4.txt');
	$fp = fopen($filename, 'w');	
	$i=1;
	foreach ($contents as $content){
		list($number, $name, $comment, $time) = explode("<>", $content);
        if($number==$_POST["number"]){
		    echo $number." <> ".$name." <>".$comment." <> ".$time."<br>\n";
         }
		else{
			$str=$i."<>".$name."<>".$comment."<>".$time;
			fwrite($fp,$str);
			$i++;
		}
	}
	fclose($fp);
}
unset($_POST["number"]);
echo "掲示板"."<br>\n";
$contents =file('mission_2-4.txt');
foreach ($contents as $content){
	list($number, $name, $comment, $time) = explode("<>", $content);
	   echo $number." <> ".$name." <>".$comment." <> ".$time."<br>\n";
      
}																	
?>

</body>
</html>
