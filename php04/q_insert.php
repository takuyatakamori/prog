<?php
session_start();
include("funcs.php");
loginCheck();

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["title"]) || $_POST["title"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]=="" ||
  !isset($_POST["tag1"]) || $_POST["tag1"]=="" 
  ){
  exit('ParamError');
}

//1. POSTデータ取得
$title = $_POST["title"];
$comment = $_POST["comment"];
$tag1 = $_POST["tag1"];
$tag2 = $_POST["tag2"];
$tag3 = $_POST["tag3"];
$q_name = $_POST["q_name"];
$u_id = $_POST["u_id"];


//2. DB接続します(エラー処理追加)
// include("funcs.php");
$pdo = db_connect();


//３．データ登録SQL作成
$sql = "INSERT INTO tkn_question_table(id, title, comment, tag1, tag2, tag3, u_id, q_name, sol, edit_flg, indate )
VALUES(NULL, :title, :comment, :tag1, :tag2, :tag3, :u_id, :q_name, 0, 0, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tag1', $tag1, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tag2', $tag2, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tag3', $tag3, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':q_name', $q_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: index.php"); //半角スペースを入れる
  exit;

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  aaa
</body>
</html>