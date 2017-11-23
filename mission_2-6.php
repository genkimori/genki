<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ＰＨＰ基礎</title>
</head>
<body>

<form action="mission_2-6.php" method="post">
    名前<br>
<input type="text" name="name" value="<?php
	if(isset($_POST['number2']) and !empty($_POST['number2'])){
	$contents =file('mission_2-6.txt');
	foreach ($contents as $content){
		list($number, $name, $comment, $password, $time) = explode('<>', $content);
        	if($number==$_POST['number2']){
			echo $name;
         	}
	}
}  ?>"><br><br>
コメント<br>
<textarea name="comment" cols="40" rows="8"><?php
	if(isset($_POST['number2']) and !empty($_POST['number2'])){
	$contents =file('mission_2-6.txt');
	foreach ($contents as $content){
		list($number, $name, $comment, $password, $time) = explode('<>', $content);
        	if($number==$_POST['number2']){
			echo $comment;
         	}
	}
} ?></textarea>
<br>パスワード<br>
<input type = "password" name = "password"

<br>
<?php 
if(isset($_POST['number2']) and !empty($_POST['number2'])) {
	 $sn=$_POST['number2'];
	 echo "<input type = 'hidden' name = 'edit' value=\"$sn\">";
 } 
?><br>//edit
<input type="submit" value="投稿"><br><br>
削除番号<br>
<input type = "text" name = "number">
<br>パスワード<br>
<input type = "password" name = "password2"><br><br>
<input type="submit" value="削除"><br>

<br>編集<br>
<input type = "text" name = "number2">
<br>パスワード<br>
<input type = "password" name = "password3"><br><br>
<input type="submit" value="編集">

</form>

<?php

	$filename = "mission_2-6.txt";
	//echo $filename."<br>\n";
$fp = fopen($filename, 'a');
$lines = file($filename); 
$num = count($lines) + 1; 
$str=$num."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$_POST["password"]."<>".date("Y/m/d H:i:s")."\n";
if(isset($_POST["name"]) and !empty($_POST["name"]) and empty($_POST['edit'])){        
fwrite($fp,$str);
echo $str."<br>\n";//投稿された物表示
unset($_POST["name"]);
unset($_POST["comment"]);
unset($_POST["edit"]);
}
fclose($fp);

echo "削除"."<br>\n";	
if(isset($_POST["number"]) and !empty($_POST["number"])){//もし番号が指定されたら
	$contents =file('mission_2-6.txt');
	$input_password = $_POST['password2']; //パスワード
	$fp = fopen($filename, 'w');	
	$i=1;
	foreach ($contents as $content){
		list($number, $name, $comment,$password, $time) = explode("<>", $content);
		if($number == $_POST["number"] && $password == $input_password) {

		    echo $number." <> ".$name." <>".$comment." <> ".$password."<>".$time."<br>\n";
         }
		else{//番号が違うならば
			$str=$i."<>".$name."<>".$comment."<>".$password."<>".$time;
			fwrite($fp,$str);//上書き保存
			$i++;
		}
				if($number ==$_POST["number"]  && $password != $input_password) {
					echo "パスワードが間違っています。"."<br>\n";
				}

	}
	fclose($fp);
unset($_POST["number"]);
}

echo "編集"."<br>\n";	
if( !empty($_POST["edit"])) {
echo $_POST["edit"]."<br>\n";
	$contents =file('mission_2-6.txt');
	$input_password = $_POST['password']; //パスワード
	$fp = fopen($filename, 'w');	
	echo $_POST["name"];
	echo $_POST["comment"];
	$i=0;
	foreach ($contents as $content){
		list($number, $name, $comment,$password, $time) = explode("<>", $content);
        if($number==$_POST["edit"] && $password == $input_password){
		    echo $_POST["edit"]." <> ".$name." <>".$comment." <> ".$time."<br>\n";
            $str=$_POST["edit"]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$password."<>".date("Y/m/d H:i:s")."\n";
			fwrite($fp,$str);

         }
		else{
			fwrite($fp,$str);
			$str=$number."<>".$name."<>".$comment."<>".$password."<>".$time;
		}
				if($number==$_POST["edit"]  && $password != $input_password) {
					echo "パスワードが間違っています。"."<br>\n";
				}

	}
	fclose($fp);
unset($_POST["name"]);
unset($_POST["comment"]);
unset($_POST["password"]);

}

echo "掲示板"."<br>\n";
$contents =file('mission_2-6.txt');
foreach ($contents as $content){
	list($number, $name, $comment,$password, $time) = explode("<>", $content);
	   echo $number." <> ".$name." <>".$comment." <> ".$password."<>".$time."<br>\n";
}
?>

</body>
</html>
