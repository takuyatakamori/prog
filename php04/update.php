<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["tknum"]) || $_POST["tknum"]=="" ||
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" 
  // !isset($_POST["image"]) || $_POST["image"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$tknum = $_POST["tknum"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

$lpw_h = password_hash($lpw, PASSWORD_DEFAULT);

//2. DB接続します(エラー処理追加)
include("funcs.php");
$pdo = db_connect();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE tkn_user_table SET u_name=:name,email=:email,tkn_num=:tknum,u_id=:lid,u_pw=:lpw WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',    $name,     PDO::PARAM_STR);
$stmt->bindValue(':email',   $email,    PDO::PARAM_STR);
$stmt->bindValue(':tknum',  $tknum,   PDO::PARAM_STR);
$stmt->bindValue(':lid',  $lid,   PDO::PARAM_STR);
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



?>
