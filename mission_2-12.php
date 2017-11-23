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

	$sql = 'SELECT * FROM tbl';

	$result = mysql_query($sql);
	if (!$result) {
	    die('queryが失敗しました。'.mysql_error());
	}

	echo "SELECT 成功<br>";


while ($row = mysql_fetch_array($result)) {
    echo $row["num"].":".$row["name"].":".$row["comment"];
	echo"<br>";
}
echo "</table>";

$close_flag = mysql_close($link); //MySQLをクローズ

if($close_flag) {
echo '切断に成功しました<br>';
}
?>
