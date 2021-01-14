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

//質問一覧の取得
$sql_q = "SELECT * FROM tkn_question_table WHERE u_id=:id";
$stmt_q = $pdo->prepare($sql_q);
$stmt_q->bindValue(':id', $id, PDO::PARAM_INT);
$status_q = $stmt_q->execute();

//データ表示
$view_q="";
if($status_q==false) {
  //execute（SQL実行時にエラーがある場合）
  $error_q = $stmt_q->errorInfo();
  exit("ErrorQuery:".$error_q[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result_q = $stmt_q->fetch(PDO::FETCH_ASSOC)){
    //$view .= "<p>".$result["indate"]."-".$result["id"]."-".$result["name"]."</p>"; //[.=]はaddしていくという意味
    $view_q .= '<div class="hover">';
    $view_q .= '<a href="detail.php?id='.$result_q["id"].'">';
    $view_q .= '<div class="date">';
    $view_q .= $result_q["indate"];
    $view_q .= "</div>";
    $view_q .= '<div class="indexTitle">';
    $view_q .= $result_q["title"];
    $view_q .= "</div>";
    $view_q .= '</a>';
    $view_q .= "</div>";
  }
}

//回答一覧の取得
$sql_a = "SELECT * FROM tkn_answer_table WHERE u_id=:id";
$stmt_a = $pdo->prepare($sql_a);
$stmt_a->bindValue(':id', $id, PDO::PARAM_INT);
$status_a = $stmt_a->execute();

//データ表示
$view_a="";
if($status_a==false) {
  //execute（SQL実行時にエラーがある場合）
  $error_a = $stmt_a->errorInfo();
  exit("ErrorQuery:".$error_a[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result_a = $stmt_a->fetch(PDO::FETCH_ASSOC)){
    //$view .= "<p>".$result["indate"]."-".$result["id"]."-".$result["name"]."</p>"; //[.=]はaddしていくという意味
    $view_a .= '<div class="hover">';
    $view_a .= '<a href="detail.php?id='.$result_a["id"].'">';
    $view_a .= '<div class="date">';
    $view_a .= $result_a["indate"];
    $view_a .= "</div>";
    $view_a .= '<div class="indexTitle">';
    $view_a .= $result_a["title"];
    $view_a .= "</div>";
    $view_a .= '</a>';
    $view_a .= "</div>";
  }
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

<form method="post" action="update.php" enctype="multipart/form-data">
  <div class="mpgJumbotron">
    <dl class="form-inner">
      <dt class="form-title">名前</dt>
      <dd class="form-item"><input type="text" name="name" class="rediTextForm" value="<?=$row["u_name"]?>"></dd>
      <dt class="form-title">Email</dt>
      <dd class="form-item"><input type="text" name="email" class="rediTextForm" value="<?=$row["email"]?>"></dd>
      <dt class="form-title">宅地建物取引士登録番号</dt>
      <dd class="form-item"><input type="text" name="tknum" class="rediTextForm" value="<?=$row["tkn_num"]?>"></dd>
      <dt class="form-title">宅建士画像</dt>
      <dd class="form-item"><img src="images/<?=$row["image"]?>" width="300" height="300" class="mpgImg"></dd>
      <dt class="form-title">ID</dt>
      <dd class="form-item"><input type="text" name="lid" class="rediTextForm" value="<?=$row["u_id"]?>"></dd>
      <dt class="form-title">PASSWORD</dt>
      <dd class="form-item"><input type="text" name="lpw" class="rediTextForm" value="<?=$row["u_pw"]?>"></dd>
      <input type="hidden" name="id" value="<?=$row["id"]?>" >
    </dl>
    <p class="btn-c">
      <input type="submit" value="更新" class="btn">
    </div>
</form>
<div class="indexWrapper">
<p class="mypageTitle">▼<?=$row["u_name"]?>さんがした質問▼</p>
<?=$view_q?>
</div>
<div class="indexWrapper">
<p class="mypageTitle">▼<?=$row["u_name"]?>さんがした回答▼</p>
<?=$view_a?>
</div>


</body>
</html>