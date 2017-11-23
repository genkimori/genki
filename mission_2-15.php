<html>

<head>
<title>簡易掲示板</title>
<META http-equiv="content-type" content="text/html;charset=utf-8">
</head>

<body>
<form action = "mission_2-15.php" method = "post">
	名前<br>
	<input type = "text" name = "name">
	<br>
	コメント<br>
	<input type = "text" name = "comment">
	<br>
	パスワード<br>
	<input type = "text" name = "password">
	<br>
		<input type = "submit" value = "投稿">
	<br>
	削除番号<br>
	<input type = "text" name = "number">	
	<br>	
	パスワード<br>
	<input type = "text" name = "password2">
	<br>										
	<input type = "submit" value = "削除">
	<br>
	編集番号<br>
	<input type = "text" name = "number2">	
	<br>					
	名前(編集)<br>
	<input type = "text" name = "name2">
	<br>
	コメント(編集)<br>
	<input type = "text" name = "comment2">
	<br>
	パスワード(編集)<br>
	<input type = "text" name = "password3">
	<br>			
	<input type = "submit" value = "編集">
	<br>

</form>
</div>


<?php
$link = mysql_connect('localhost', 'co-963.it.99sv-coco.c', 'uJugi7Hg'); //接続先を指定
$charset = mysql_client_encoding($link); //クライアントの文字セット

if (!$link) {
    die('接続できませんでした: ' . mysql_error());
}

$dbname = co_963_it_99sv_coco_com; //データベースの名前
$db_selected = mysql_select_db($dbname, $link); //データベース先を指定
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

mysql_set_charset('utf8');




//データ挿入;
if(isset($_POST['name']) and !empty($_POST['name']) ) {
	$tablename="tbe";
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$password = $_POST['password'];
	$date =date('Y-m-d H:i:s');
	$sql = 'INSERT INTO '.$tablename.'(name, comment, password, date)
			VALUES( "'.$name.'", "'.$comment.'", "'.$password.'", "'.$date.'")';
	$result = mysql_query($sql);
	if (!$result) {
	    die('queryが失敗しました。'.mysql_error());
	}
}




//削除;
if(isset($_POST['number']) and ($_POST['password2'])) {
		$num = intval($_POST['number']);
		$input_password = $_POST['password2']; //パスワード
		$sql = "SELECT password FROM tbe WHERE num = $num";

			$result = mysql_query($sql);
			if (!$result) {
			    die('クエリーが失敗しました。'.mysql_error());
			}

			while ($raw = mysql_fetch_array($result)) {
			    $password = $raw['password'];
			}
		if($input_password == $password) {
		$sql = 'DELETE FROM tbe  WHERE num = "'.$num.'"';
		$result = mysql_query($sql);
			if (!$result) {
	    		die('queryが失敗しました。'.mysql_error());
			}
}
else {
				echo "パスワードが間違っています。"."<br>\n";
}
}




//編集;
if(isset($_POST['number2']) and isset($_POST['name2']) and isset($_POST['password3'])) {
	$num = intval($_POST['number2']);
	$name = $_POST['name2'];
	$comment = $_POST['comment2'];
	$password = $_POST['password3'];
	$date =date('Y-m-d H:i:s');
	$sql = "SELECT password FROM tbe WHERE num = $num";
	$result = mysql_query($sql);
		if (!$result) {
			die('クエリーが失敗しました。'.mysql_error());
		}
			while ($raw = mysql_fetch_array($result)) {
			    $password2 = $raw['password'];
			}
				if($password == $password2) {
					$sql = 'UPDATE tbe SET name = "'.$name.'", comment = "'.$comment.'", password = "'.$password.'", date = "'.$date.'" WHERE num = "'.$num.'"';
					$result = mysql_query($sql);
					if (!$result) {
	   					 die('queryが失敗しました。'.mysql_error());
					}
				}
				else{
					echo"パスワードが間違っています";
				}	
}






//データ表示;
	$sql = 'SELECT * FROM tbe';	//selectによって表示

	$result = mysql_query($sql);
	if (!$result) {
	    die('queryが失敗しました。'.mysql_error());
	}

echo "＜掲示板＞<br>";
while ($row = mysql_fetch_array($result)) {
    echo  $row["num"].":".$row["name"].":".$row["comment"].":".$row["password"].":".$row["date"];
	echo"<br>";
}         
echo "</table>";


$close_flag = mysql_close($link); //MySQLをクローズ

?>

</body>

</html>