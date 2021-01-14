<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link href="css/reset.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/sanitize.css" rel="stylesheet">
<title>ログイン</title>
</head>
<body class="loginBody">

<!-- Head[Start] -->
<!-- <?php
include("l_header.html");
?> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="loginTitle">
  ログイン
</div>
<form method="post" action="login_act.php">
  <div class="jumbotron">
    <div class="loginField">
      <label><input type="text" name="lid" placeholder="ID" class="textForm"></label><br>
      <label><input type="text" name="lpw" placeholder="パスワード" class="textForm"></label><br>
      <input type="submit" value="ログイン" class="btn">
      <p class="kochira"><a href="redistry.php">会員登録はこちら</a></p>
    </div>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
