<html>

<head>
<title>簡易掲示板</title>
<META http-equiv="content-type" content="text/html;charset=utf-8">
</head>

<body>
<form action = "mission_3-8.php" method = "post" enctype="multipart/form-data">
	<fieldset>
	<legend>投稿</legend>
	名前<br>
	<input type = "text" name = "name" placeholder="名前を入力" 
	value="<?php if (!empty($_POST["name"])) {echo htmlspecialchars($_POST["name"], ENT_QUOTES);} ?>"
	value="<?php session_start(); echo htmlspecialchars($_SESSION["username"], ENT_QUOTES); ?>">
	<br>
	コメント<br>
	<input type = "text" name = "comment" placeholder="コメントを入力" 
	value="<?php if (!empty($_POST["comment"])) {echo htmlspecialchars($_POST["comment"], ENT_QUOTES);} ?>">
	<br>
	パスワード<br>
	<input type = "text" name = "password" placeholder="パスワードを入力"
	value="<?php if (!empty($_POST["password"])) {echo htmlspecialchars($_POST["password"], ENT_QUOTES);} ?>">
	<br><br>
	画像登録
	<br>
	<INPUT type="file" name="upfile" size="30">
	<br><br>
	<input type = "submit" value = "投稿">
	</fieldset>
	<br>
	<fieldset>
	<legend>削除</legend>
	削除番号<br>
	<input type = "text" name = "number" placeholder="削除番号を入力"	
	value="<?php if (!empty($_POST["number"])) {echo htmlspecialchars($_POST["number"], ENT_QUOTES);} ?>">
	<br>	
	パスワード<br>
	<input type = "text" name = "password2" placeholder="パスワードを入力"
	value="<?php if (!empty($_POST["password2"])) {echo htmlspecialchars($_POST["password2"], ENT_QUOTES);} ?>">
	<br>										
	<input type = "submit" value = "削除">
	<br>
	</fieldset>
	<fieldset>
	<legend>編集</legend>
	編集番号<br>
	<input type = "text" name = "number2" placeholder="編集番号を入力"	
	value="<?php if (!empty($_POST["number2"])) {echo htmlspecialchars($_POST["number2"], ENT_QUOTES);} ?>">	
	<br>					
	名前(編集)<br>
	<input type = "text" name = "name2" placeholder="名前を入力" 
	value="<?php if (!empty($_POST["name2"])) {echo htmlspecialchars($_POST["name2"], ENT_QUOTES);} ?>">
	<br>
	コメント(編集)<br>
	<input type = "text" name = "comment2" placeholder="コメントを入力" 
	value="<?php if (!empty($_POST["comment2"])) {echo htmlspecialchars($_POST["comment2"], ENT_QUOTES);} ?>">
	<br>
	パスワード(編集)<br>
	<input type = "text" name = "password3" placeholder="パスワードを入力"
	value="<?php if (!empty($_POST["password3"])) {echo htmlspecialchars($_POST["password3"], ENT_QUOTES);} ?>">
	<br>			
	<input type = "submit" value = "編集">
	<br>
	</fieldset>

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
	//tablename=mission_2-15のテーブル
	$tablename="tbe";
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$password = $_POST['password'];
	$date =date('Y-m-d H:i:s');
	$sql = 'INSERT INTO '.$tablename.'(name, comment, password,date)	
			VALUES( "'.$name.'", "'.$comment.'", "'.$password.'",  "'.$date.'")';
	$result = mysql_query($sql);
	if (!$result) {
	    die('queryが失敗しました。'.mysql_error());
	}
}



//画像処理
if($_FILES){
	//アップロードされたファイルの値を取得
	$name = $_FILES['upfile']['name'];
	$type = $_FILES['upfile']['type'];
	$size = $_FILES['upfile']['size'];
	$tmp_name = $_FILES['upfile']['tmp_name'];
	$error = $_FILES['upfile']['error'];
	switch($_FILES['upfile']['type']) {
		case 'image/jpeg': $ext = 'jpg'; break;
		case 'image/gif':  $ext = 'gif'; break;
		case 'image/png':  $ext = 'png'; break;
		case 'image/tiff': $ext = 'tif'; break;
		case 'video/mp4':  $ext = 'mp4'; break;
		default:	   $ext = '';	 break;
	}
	if($ext) {
		//updateしたIDを知りたい場合 select LAST_INSERT_ID()
		$sql = 'select LAST_INSERT_ID() AS id FROM image4';
		$result = mysql_query($sql);
		if(!result) {
			die('クエリ―0が失敗しました。'.mysql_error());
		}
		while ($raw = mysql_fetch_array($result)) {
			$id = $raw['id'];
		}
	}
	$id = intval($id);
	$imgdat = file_get_contents($tmp_name);
	$imgdat = mysql_real_escape_string($imgdat);
	$sql = 'INSERT INTO '.image4.' (id, name, type, ext, raw_data)
	VALUES('.$id.', "'.$name.'", "'.$type.'", "'.$ext.'", "'.$imgdat.'")';
	$result =mysql_query($sql);
	if(!result) {
		die('クエリ―1が失敗しました。'.mysql_error());
	}
}




//削除;
if(isset($_POST['number']) and ($_POST['password2'])) {
		$num = intval($_POST['number']);
		$input_password = $_POST['password2']; //パスワード
		$sql = "SELECT password FROM tbe WHERE num = $num";

			$result = mysql_query($sql);
			if (!$result) {
			    die('クエリー2が失敗しました。'.mysql_error());
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
			die('クエリー3が失敗しました。'.mysql_error());
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






//データ表示
$sql = 'SELECT * FROM tbe';	//selectによって表示
$result = mysql_query($sql);
if (!$result) {
	   die('query4が失敗しました。'.mysql_error());
}
echo "＜掲示板＞<br>";
while ($row = mysql_fetch_array($result)) {
	$num = $row['num'];
	//画像をアップしたとこのIDをセレクト
	$sql = "SELECT id FROM image4 WHERE id = $num";
	$result2 =mysql_query($sql);
	if (!$result2) {
		die('クエリ―5が失敗しました。'.mysql_error());
	}
	$display = "";
	while ($raw2 = mysql_fetch_array($result2)) {
			 $display = $raw2['id'];
	}
	//画像がからでなければ
	if(!empty($display)) {
		    echo  $row["num"].":".$row["name"].":".$row["comment"].":".$row["password"].":"."<a href='mission_3-8image.php?id=$display'>画像を確認</a>".":".$row["date"];
			echo"<br>";
			//選択した画像のＩＤをmission_3-8image.phpに移す
	} 
	//画像がからであるなら
	else{
		    echo  $row["num"].":".$row["name"].":".$row["comment"].":".$row["password"].":"."画像なし".":".$row["date"];
			echo"<br>";
	}
}        
echo "</table>";
$close_flag = mysql_close($link); //MySQLをクローズ
?>

</body>

</html>