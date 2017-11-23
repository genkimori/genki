<?php
$link = mysql_connect('localhost', 'co-963.it.99sv-coco.c', 'uJugi7Hg'); //接続先を指定
$dbname = 'co_963_it_99sv_coco_com';
if (!$link) {
    die('接続できませんでした: ' . mysql_error());
}
echo '接続に成功しました<br>';

$db_selected = mysql_select_db($dbname, $link); //データベース先を指定
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

echo $dbname.'データベースを選択しました。<br>';

$tablename = "tbl_name";
$sql = "DESCRIBE $tablename";
echo "SQL文 : ".$sql."<br>";

$result = mysql_query($sql);
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}

echo "<table border='1' cellpadding='3' cellspacing='0'>";
echo "<tr><td>Field</td><td>Type</td><td>Null</td></tr>";
while ($row = mysql_fetch_row($result)) {
    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
}
echo "</table>";

$close_flag = mysql_close($link); //MySQLをクローズ
?>