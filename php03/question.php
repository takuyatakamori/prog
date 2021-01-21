<?php
session_start();
include("funcs.php");
loginCheck();
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
<form method="post" action="q_insert.php" enctype="multipart/form-data">
  <div class="qtnJumbotron">
    <dl class="form-inner">
      <dt class="form-title">タイトル</dt>
      <dd class="form-item"><input type="text" name="title" class="qtnTextForm"></dd>
      <dt class="form-title">内容</dt>
      <dd class="form-item"><textarea name="comment" cols="30" rows="10" class="qtnTextForm"></textarea></dd>
      <dt class="form-title">タグ1</dt>
      <dd class="form-item"><input type="text" name="tag1" class="qtnTextForm"></dd>
      <dt class="form-title">タグ2</dt>
      <dd class="form-item"><input type="text" name="tag2" class="qtnTextForm"></dd>
      <dt class="form-title">タグ3</dt>
      <dd class="form-item"><input type="text" name="tag3" class="qtnTextForm"></dd>
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
