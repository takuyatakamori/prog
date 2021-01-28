<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

?>

<!DOCTYPE html>
<html>
<head>
<link href="css/reset.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/sanitize.css" rel="stylesheet">
<title>メール登録画面</title>
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
<form action="registration_mail_check.php" method="post">
<input type="text" name="mail" size="50" class="textForm" placeholder="メールアドレス"><br>
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="登録する" class="btn">
</div>
</div>

</form>

</body>
</html>