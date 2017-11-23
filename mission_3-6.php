<?php


// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
	//パスワードなど描いている場合、データーベース接続
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        $username = $_POST["username"];
        $password = $_POST["password"];
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
		//パスワードとユーザーID格納
		$sql="INSERT INTO data1(name,password) VALUES('$username','$password')";
		$result = mysql_query($sql);
		if (!$result) {
	  	  die('queryが失敗しました。'.mysql_error());
		}
	    //userid発行
		$sql = "SELECT num FROM data1";
		$result = mysql_query($sql);
		if (!$result) {
			die('クエリーが失敗しました。'.mysql_error());
		}
		while ($raw = mysql_fetch_array($result)) {
			   $userid = $raw['num'];
		}
		echo '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
	}
    else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>新規登録</title>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
                <label for="username">ユーザー名</label><input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <input type="submit" id="signUp" name="signUp" value="新規登録">
            </fieldset>
        </form>
        <br>
        <form action="mission_3-6.php">
        </form>
    </body>