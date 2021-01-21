<?php

session_start();

header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
if ($_POST['token'] != $_SESSION['token']){
	echo "不正アクセスの可能性あり";
	exit();
}

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
include("funcs.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: registration_mail_form.php");
	exit();
}else{
	//POSTされたデータを変数に入れる
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
	
	//メール入力判定
	if ($mail == ''){
		$errors['mail'] = "メールが入力されていません。";
	}else{
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
			$errors['mail_check'] = "メールアドレスの形式が正しくありません。";
		}
    //DB確認        
		$sql = "SELECT id FROM tkn_user_table WHERE email=:mail";
		$stm = $dbh->prepare($sql);
		$stm->bindValue(':mail', $mail, PDO::PARAM_STR);
		
		$stm->execute();
		$result = $stm->fetch(PDO::FETCH_ASSOC);
		//user テーブルに同じメールアドレスがある場合、エラー表示
		if(isset($result["id"])){
		$errors['user_check'] = "このメールアドレスはすでに利用されております。";
		}

	}
}

if (count($errors) === 0){
	
	$urltoken = hash('sha256',uniqid(rand(),1));
	$url = "https://beexs.jp/php02/redistry.php"."?urltoken=".$urltoken;
	
	//ここでデータベースに登録する
	try{
		//例外処理を投げる（スロー）ようにする
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$statement = $dbh->prepare("INSERT INTO tkn_pre_table (urltoken,mail,date) VALUES (:urltoken,:mail,now() )");
		
		//プレースホルダへ実際の値を設定する
		$statement->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
		$statement->bindValue(':mail', $mail, PDO::PARAM_STR);
		$statement->execute();
			
		//データベース接続切断
		$dbh = null;	
		
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	//メールの宛先
	$mailTo = $mail;
 
	//Return-Pathに指定するメールアドレス
	$returnMail = 'web@sample.com';
 
	$name = "たくちゃんショップ";
	$mail = 'web@sample.com';
	$subject = "【たくちゃんショップ】会員登録用URLのお知らせ";

$body = <<< EOM
メールアドレスを確認しました。
24時間以内に下記のURLからご登録下さい。
{$url}
EOM;

	mb_language('ja');
	mb_internal_encoding('UTF-8');
 
	//Fromヘッダーを作成
	$header = 'From: ' . mb_encode_mimeheader($name). ' <' . $mail. '>';
 
	if (mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail)) {
	
	 	//セッション変数を全て解除
		$_SESSION = array();
	
		//クッキーの削除
		if (isset($_COOKIE["PHPSESSID"])) {
			setcookie("PHPSESSID", '', time() - 1800, '/');
		}
	
 		//セッションを破棄する
 		session_destroy();
 	
 		$message = "メールをお送りしました。<br>24時間以内にメールに記載されたURLからご登録下さい。";
 	
	 } else {
		$errors['mail_error'] = "メールの送信に失敗しました。";
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
<link href="css/reset.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/sanitize.css" rel="stylesheet">
<title>メール確認画面</title>
<meta charset="utf-8">
</head>
<body class="loginBody">
  <!-- <?php
include("l_header.html");
?> -->
<div class="loginTitle">
メール登録画面
</div>
<div class="jumbotron">
<div class="loginField">
<?php if (count($errors) === 0): ?>

<p class="alert"><?=$message?></p>

<br>
<p>↓このURLが記載されたメールが届きます。</p>
<a href="<?=$url?>" class="maillink"><?=$url?></a>

<?php elseif(count($errors) > 0): ?>

<?php
foreach($errors as $value){
	echo '<p class="alert">'.$value.'</p>';
}
?>
<br>
<input type="button" value="戻る" onClick="history.back()" class="btn">
</div>
</div>

<?php endif; ?>
</body>
</html>