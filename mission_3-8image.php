<?php
$link = mysql_connect('localhost', 'co-963.it.99sv-coco.c', 'uJugi7Hg'); //接続先を指定
$dbname = 'co_963_it_99sv_coco_com';
$charset = mysql_client_encoding($link); //クライアントの文字セット

if (!$link) {
    die('接続できませんでした: ' . mysql_error());
}
echo '接続に成功しました<br>';

$db_selected = mysql_select_db($dbname, $link);   //データベース先を指定
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

echo $dbname.'データベースを選択しました。<br>';
mysql_set_charset('utf8');
$id = $_GET['id'];
$image4="image4";
$sql = "SELECT * FROM $image4 WHERE id = $id";
$result = mysql_query($sql);
if (!$result) {
	   die('クエリ―が失敗しました。'.mysql_error());
}
while ($raw = mysql_fetch_array($result)){
	$name = $raw['name'];
	$type = $raw['type'];
	$raw_data = $raw['raw_data'];
}
header("Content-Type: $type");
readfile($name);
//echo $raw_data;
//print("<img src=\"$raw_data\">");
?>
