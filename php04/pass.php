<?php

session_start();
include("funcs.php");
loginCheck();

//GETでid値を取得
$id =$_SESSION["id"];

//DB接続
$pdo = db_connect();

//ユーザー情報の取得
$sql = "SELECT * FROM tkn_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/sanitize.css" rel="stylesheet">
</head>
<body>
<?php
include("header.html");
?>
<form method="post" action="p_update.php" enctype="multipart/form-data">
  <div class="mpgJumbotron">
    <dl class="form-inner">
      <dt class="form-title">現在のPASSWORD</dt>
      <dd class="form-item"><input type="password" name="cupw" class="rediTextForm"></dd>
      <dt class="form-title">新しいPASSWORD</dt>
      <dd class="form-item"><input type="password" name="lpw" class="rediTextForm"></dd>
      <dt class="form-title">確認用PASSWORD</dt>
      <dd class="form-item"><input type="password" name="copw" class="rediTextForm"></dd>
      <input type="hidden" name="id" value="<?=$row["id"]?>" >
    </dl>
    <p class="btn-c">
      <input type="submit" value="更新" class="btn">
    </div>
</form>
</body>
</html>