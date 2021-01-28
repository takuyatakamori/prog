<?php
session_start();
include("funcs.php");
loginCheck();

 // もしPOST送信されていたら
if(!empty($_POST)){
  $sol = $_POST['sol'];

  //DB接続
  $pdo = db_connect();

  $sql = 'UPDATE tkn_question_table SET sol=1 WHERE id=:sol';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':sol', $sol, PDO::PARAM_INT);
  $status = $stmt->execute();

  if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  
  }else{
    //select.phpへリダイレクト
    header('Location: detail.php?id='.$sol.'');
    exit;
  
  }
  
}


