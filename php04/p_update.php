<?php

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" 
  // !isset($_POST["image"]) || $_POST["image"]==""
){
  exit('ParamError');
}


//1. POSTデータ取得
$id = $_POST["id"];
$cupw = $_POST["cupw"]; //現在のパスワード
$lpw = $_POST["lpw"];//新しいパスワード
$copw = $_POST["copw"];//新しいパスワードの確認

if($lpw != $copw){
  exit('パスワードが一致しません');
}

$lpw_h = password_hash($lpw, PASSWORD_DEFAULT);

//DB接続します(エラー処理追加)
include("funcs.php");
$pdo = db_connect();

//データ登録SQL作成
$sql = "SELECT * FROM tkn_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}
$val = $stmt->fetch(); //1レコードだけ取得する方法

if(password_verify($cupw, $val["u_pw"])){ 
//UPDATEで更新(bindValue)
$sql = 'UPDATE tkn_user_table SET u_pw=:lpw WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lpw',  $lpw_h,   PDO::PARAM_STR);
$stmt->bindValue(':id',      $id,       PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: mypage.php");
  exit;

}
}else{
  echo 'パスワードが間違っています。';

}

?>
