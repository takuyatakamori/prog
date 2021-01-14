<?php
session_start();
include("funcs.php");
loginCheck();

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["title"]) || $_POST["title"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]=="" ||
  !isset($_POST["u_id"]) || $_POST["u_id"]=="" ||
  !isset($_POST["q_id"]) || $_POST["q_id"]=="" 
){
  exit('ParamError');
}

//1. POSTデータ取得
$title = $_POST["title"];
$comment = $_POST["comment"];
$u_id = $_POST["u_id"];
$q_id = $_POST["q_id"];


//2. DB接続します(エラー処理追加)
// include("funcs.php");
$pdo = db_connect();


//３．データ登録SQL作成
$sql = "INSERT INTO tkn_answer_table(id, q_id, u_id, title, comment, indate )
VALUES(NULL, :q_id, :u_id, :title, :comment, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':q_id', $q_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
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