<?php
//セッション開始
session_start();
// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } 
	else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } 
	if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
	$userid = $_POST["userid"];
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
	//data1に入っている数値を選択できるようにする
	$sql="SELECT * FROM data1";
	$result = mysql_query($sql);
	if (!$result) {
	 	  die('queryが失敗しました。'.mysql_error());
	}
	while ($raw = mysql_fetch_array($result)) {
		$id_password = $raw['password'];
		$id_name = $raw['name'];
		$id_num = $raw['num'];
	}
	//パスワードとIDが合っている場合、ユーザーの名前をセッションに格納
	if($id_password == $_POST["password"] and $id_num == $_POST["userid"]){
		$_SESSION["username"]=$id_name;
	}
	else{
		echo 'ユーザーIDあるいはパスワードに誤りがあります。';
	}
	}
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <form id="loginForm" name="loginForm" action="mission_3-7.php" method="POST">
            <fieldset>
                <legend>ログインフォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <label for="userid">ユーザーID</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
            </fieldset>
        </form>
        <br>
        <form action="mission_3-6.php">
            <fieldset>          
                <legend>新規登録フォーム</legend>
                <input type="submit" value="新規登録">
            </fieldset>
        </form>
    </body>
</html>