<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/write.css">
  <title>書き込み完了画面</title>
</head>
<?php
//文字作成
$name = $_POST["name"];
$mail = $_POST["mail"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$ani = $_POST["ani"];
$otouto = $_POST["otouto"];
$ane = $_POST["ane"];
$imouto = $_POST["imouto"];
$rating = $_POST["rating"];
$str = $name.",".$mail.",".$gender.",".$age.",".$ani.",".$otouto.",".$ane.",".$imouto.",".$rating.",";

// $datas = array(
//   array($name,$mail,$gender,$age,$from,$motto)
// );

//File書き込み
$file = fopen("data/data.txt","a");	// ファイル読み込み
fwrite($file, $str."\n"); // \n 改行コード
fclose($file);

// $fp = fopen("data/data.txt","a");
// foreach($datas as $data){
// $line = implode(",",$data);
// fwrite($fp, $line."\n");
// }
// fclose($fp);

?>
<body>
<div class="wrapper">
<h1>ご回答ありがとうございました！</h1>
<img src="img/arigato.png" alt="ありがとう" class="mainimg">
<div class="bt-area">
  <a href="read.php">アンケート結果はこちら</a>
</div>
<div>
  <a href="post.php">>>アンケート画面に戻る</a>
</div>
</div>
</body>
</html>