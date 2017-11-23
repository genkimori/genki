<html>

<head>
<title>簡易掲示板(編集)</title>
<META http-equiv="content-type" content="text/html;charset=utf-8">
</head>

<body>
<form action = "mission_2-13.php" method = "post">
	編集投稿番号<br>
	<input type = "text" name = "num">
	<br>
	名前(編集)<br>
	<input type = "text" name = "name">
	<br>
	コメント(編集)<br>
	<input type = "text" name = "comment">
	<br>
	<input type = "submit" value = "編集">
</form>
</div>


<?php
$link = mysql_connect('localhost', 'co-963.it.99sv-coco.c', 'uJugi7Hg'); //接続先を指定
$charset = mysql_client_encoding($link); //クライアントの文字セット

echo 'クライアントの文字セットは:'.$charset.'<br>';

if (!$link) {
    die('接続できませんでした: ' . mysql_error());
}
echo '接続に成功しました<br>';

$dbname = co_963_it_99sv_coco_com; //データベースの名前
$db_selected = mysql_select_db($dbname, $link); //データベース先を指定
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

echo $dbname.'データベースを選択しました。<br>';

mysql_set_charset('utf8');

if(isset($_POST['name']) and !empty($_POST['name']) and !empty($_POST['num'])) {
	$num = intval($_POST['num']);
	$name = $_POST['name'];
	$comment = $_POST['comment'];

	$sql = 'UPDATE tbl SET name = "'.$name.'", comment = "'.$comment.'" WHERE num = "'.$num.'"';
	echo "SQL文 : ".$sql."<br>";

	$result = mysql_query($sql);
	if (!$result) {
	    die('queryが失敗しました。'.mysql_error());
	}

	echo "UPDATE 成功<br>";
}
else {
	echo "未入力<br>";
}

$close_flag = mysql_close($link); //MySQLをクローズ

if($close_flag) {
echo '切断に成功しました<br>';
}
?>

</body>

</html>