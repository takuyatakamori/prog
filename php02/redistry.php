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
      <dt class="form-title">Email</dt>
      <dd class="form-item"><input type="text" name="email" class="rediTextForm"></dd>
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
      <input type="submit" value="登録" class="btn">
    </p>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
