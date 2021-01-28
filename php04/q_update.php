<?php
session_start();
include("funcs.php");
loginCheck();

//GETでid値を取得
$id =$_GET["id"];

//q_id値を取得(ログインしている人のID)
$q_id =$_SESSION["id"];

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["comment"]) || $_POST["comment"]=="" ||
  !isset($_POST["tag1"]) || $_POST["tag1"]=="" 
  ){
  exit('ParamError');
}

//1. POSTデータ取得
$comment = $_POST["comment"];
$tag1 = $_POST["tag1"];
$tag2 = $_POST["tag2"];
$tag3 = $_POST["tag3"];
$q_name = $_POST["q_name"];
$u_id = $_POST["u_id"];

//DB接続
$pdo = db_connect();

//３．データ登録SQL作成
$sql = 'UPDATE tkn_question_table SET comment=:comment, tag1=:tag1, tag2=:tag2, tag3=:tag3, edit_flg=1 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',      $id,       PDO::PARAM_INT);    //更新したいidを渡す
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tag1', $tag1, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tag2', $tag2, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tag3', $tag3, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header('Location: detail.php?id='.$id.''); //半角スペースを入れる
  exit;

}
?>
