<?php
session_start();
include("funcs.php");
loginCheck();

//GETでid値を取得
$id =$_GET["id"];

//q_id値を取得(ログインしている人のID)
$q_id =$_SESSION["id"];

//DB接続
$pdo = db_connect();

//SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM tkn_question_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>質問投稿</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/sanitize.css" rel="stylesheet">
</head>
<body>

<!-- Head[Start] -->
<?php
include("header.html");
?>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="loginTitle">
  質問を投稿する
</div>
<form method="post" action="q_update.php?id=<?=$id?>" enctype="multipart/form-data">
  <div class="qtnJumbotron">
    <dl class="form-inner">
      <dt class="form-title">タイトル</dt>
      <dd class="form-item"><p class="editTitle"><?=$row[title]?></p></dd>
      <dt class="form-title">内容</dt>
      <dd class="form-item"><textarea name="comment" cols="30" rows="10" class="qtnTextForm" ><?=$row[comment]?></textarea></dd>
      <dt class="form-title">タグ1</dt>
      <dd class="form-item"><input type="text" name="tag1" class="qtnTextForm" value="<?=$row[tag1]?>"></dd>
      <dt class="form-title">タグ2</dt>
      <dd class="form-item"><input type="text" name="tag2" class="qtnTextForm" value="<?=$row[tag2]?>"></dd>
      <dt class="form-title">タグ3</dt>
      <dd class="form-item"><input type="text" name="tag3" class="qtnTextForm" value="<?=$row[tag3]?>"></dd>
      <!-- user_tableの質問者名 -->
      <input type="hidden" name="q_name" value="<?=$_SESSION["u_name"]?>" >
      <!-- user_tableのユニークID -->
      <input type="hidden" name="u_id" value="<?=$_SESSION["id"]?>" >
      <!-- solをhiddenで -->
      <input type="hidden" name="q_name" value="<?=$_SESSION["u_name"]?>" >
    </dl>
    <p class="btn-c">
      <input type="submit" value="投稿" class="btn">
    </p>
  </div>
</form>
<!-- Main[End] -->

<?php
include("footer.html");
?>

</body>
</html>
