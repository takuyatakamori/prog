<?php
session_start();
include("funcs.php");
loginCheck();

//GETでid値を取得
$id =$_GET["id"];

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

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
}

//回答の呼び出し（SELECT文）
$sql_a = "SELECT * FROM tkn_answer_table WHERE q_id=:id";
$stmt_a = $pdo->prepare($sql_a);
$stmt_a->bindValue(':id', $id, PDO::PARAM_INT);
$status_a = $stmt_a->execute();

//回答の表示
$view_a="";
if($status_a==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt_a->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  while( $result = $stmt_a->fetch(PDO::FETCH_ASSOC)){
    //$view .= "<p>".$result["indate"]."-".$result["id"]."-".$result["name"]."</p>"; //[.=]はaddしていくという意味
    $view_a .= '<div class="answer">';
    $view_a .= '<p class="asrDate">';
    $view_a .= $result["indate"];
    $view_a .= '</p>';
    $view_a .= '<p class="asrTitle">';
    $view_a .= $result["title"];
    $view_a .= '</p>';
    $view_a .= '<p class="asrComment">';
    $view_a .= $result["comment"];
    $view_a .= '</p>';
    $view_a .= '</div>';

  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
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
<div class="dtlMainWrapper">
  <div class="dtlWrapper">
    <p class="dtlDate"><?=$row["indate"]?></p>
    <p class="dtlTitle"><?=$row["title"]?></p>
    <p class="dtlName">質問者：<?=$row["q_name"]?></p>
    <p class="dtlComment">質問内容：<br><?=$row["comment"]?></p>
  </div>
  <p class="dtlTag">
    <a href="tag.php?tag=<?=$row["tag1"]?>"><?=$row["tag1"]?></a>
    <a href="tag.php?tag=<?=$row["tag2"]?>"><?=$row["tag2"]?></a>
    <a href="tag.php?tag=<?=$row["tag3"]?>"><?=$row["tag3"]?></a>
  </p>
  <button class="asrButtonWrapper"><a href="#asrForm" class="asrButton">回答する</a></button>
</div>
<div class="asrWrapper">
  <?=$view_a?>
</div>

<form method="post" action="asr_insert.php">
  <div class="asrJumbotron"><a id="asrForm"></a>
    <dl class="form-inner">
      <dt class="form-title">タイトル</dt>
      <dd class="form-item"><input type="text" name="title" class="qtnTextForm"></dd>
      <dt class="form-title">回答内容</dt>
      <dd class="form-item"><textArea name="comment" rows="4" cols="40" class="qtnTextForm"></textArea></dd>
      <!-- user_tableのユニークID -->
      <input type="hidden" name="u_id" value="<?=$_SESSION["id"]?>" >
      <!-- question_tableのユニークID -->
      <input type="hidden" name="q_id" value="<?=$row["id"]?>" >
    </dl>
    <p class="btn-c">
      <input type="submit" value="回答する" class="btn">
    </p>
</div>
</form>
<!-- Main[End] -->


</body>
</html>