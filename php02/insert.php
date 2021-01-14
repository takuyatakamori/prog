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
$name = $_POST["name"];
$email = $_POST["email"];
$tknum = $_POST["tknum"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$image = $_POST["image"];

$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
$image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
$file = "images/$image";


//2. DB接続します(エラー処理追加)
include("funcs.php");
$pdo = db_connect();


//３．データ登録SQL作成
$sql = "INSERT INTO tkn_user_table(id, u_name, u_id, u_pw, email, tkn_num, image, life_flg, indate )
VALUES(NULL, :u_name, :u_id, :u_pw, :email, :tkn_num, :image, 0, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_id', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_pw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tkn_num', $tknum, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $image, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $status = $stmt->execute();
if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
  move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
  if (exif_imagetype($file)) {//画像ファイルかのチェック
      $message = '画像をアップロードしました';
  } else {
      $message = '画像ファイルではありません';
  }
}
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．login.phpへリダイレクト
  header("Location: login.php"); //半角スペースを入れる
  exit;

}
?>
