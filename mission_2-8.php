<?php
$link = mysql_connect('localhost', 'co-963.it.99sv-coco.c', 'uJugi7Hg'); //接続先を指定
$dbname = 'co_963_it_99sv_coco_com';
$charset = mysql_client_encoding($link); //クライアントの文字セット

if (!$link) {
    die('接続できませんでした: ' . mysql_error());
}
echo '接続に成功しました<br>';

$db_selected = mysql_select_db($dbname, $link); //データベース先を指定
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

echo $dbname.'データベースを選択しました。<br>';

mysql_set_charset('utf8');

$sql = "CREATE TABLE tbl2 (
name VARCHAR(20) NOT NULL,
comment VARCHAR(1000),
password VARCHAR(20)
)";											
echo "SQL文 : ".$sql."<br>";				//テーブル名＝tbl

$result = mysql_query($sql);
if (!$result) {
    die('queryが失敗しました。'.mysql_error());
}

$close_flag = mysql_close($link); //MySQLをクローズ

?>