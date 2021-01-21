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

if(empty($_GET)) {
	header("Location: registration_mail_form.php");
	exit();
}else{
	//GETデータを変数に入れる
	$urltoken = isset($_GET[urltoken]) ? $_GET[urltoken] : NULL;
	//メール入力判定
	if ($urltoken == ''){
		$errors['urltoken'] = "もう一度登録をやりなおして下さい。";
	}else{
		try{
			//例外処理を投げる（スロー）ようにする
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//flagが0の未登録者・仮登録日から24時間以内
			$statement = $dbh->prepare("SELECT mail FROM tkn_pre_table WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour");
			$statement->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
			$statement->execute();
			
			//レコード件数取得
			$row_count = $statement->rowCount();
			
			//24時間以内に仮登録され、本登録されていないトークンの場合
			if( $row_count ==1){
				$mail_array = $statement->fetch();
				$mail = $mail_array[mail];
				$_SESSION['mail'] = $mail;
			}else{
				$errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎた等の問題があります。もう一度登録をやりなおして下さい。";
			}
			
			//データベース接続切断
			$dbh = null;
			
		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/sanitize.css" rel="stylesheet">
  <title>会員登録</title>
</head>
<body class="loginBody">

<?php if (count($errors) === 0): ?>
<!-- Head[Start] -->
<!-- <?php
include("l_header.html");
?> -->

<!-- Head[End] -->

<!-- Main[Start] -->
<div class="loginTitle">
  会員登録
</div>
<form method="post" action="insert.php" enctype="multipart/form-data">
  <div class="rediJumbotron">
    <dl class="form-inner">
      <dt class="form-title">名前</dt>
      <dd class="form-item"><input type="text" name="name" class="rediTextForm"></dd>
      <dt class="form-title form-email">Email</dt>
      <dd class="form-item">
			<p class="rediTextFormMail">
			<?=htmlspecialchars($mail, ENT_QUOTES, 'UTF-8')?></p></dd>
      <!-- <dd class="form-item"><input type="text" name="email" class="rediTextForm"></dd> -->
      <dt class="form-title">宅地建物取引士登録番号</dt>
      <dd class="form-item"><input type="text" name="tknum" class="rediTextForm"></dd>
      <dt class="form-title">宅建士画像</dt>
      <dd class="form-item"><input type="file" name="image" class="file"></dd>
      <dt class="form-title">ID</dt>
      <dd class="form-item"><input type="text" name="lid" class="rediTextForm"></dd>
      <dt class="form-title">PASSWORD</dt>
      <dd class="form-item"><input type="text" name="lpw" class="rediTextForm"></dd>
    </dl>
    <p class="btn-c">
      <input type="hidden" name="token" value="<?=$token?>">
      <input type="submit" value="登録" class="btn">
    </p>
  </div>
</form>
<!-- Main[End] -->

<?php
include("footer.html");
?>

<?php elseif(count($errors) > 0): ?>
 
 <?php
 foreach($errors as $value){
   echo "<p>".$value."</p>";
 }
 ?>
  
 <?php endif; ?>

</body>
</html>
