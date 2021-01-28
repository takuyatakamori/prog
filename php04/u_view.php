<?php
//1.GETでid値を取得
$id =$_GET["id"];

include("funcs.php");
loginCheck();

$pdo = db_connect();

//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM gs_an_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<?php
include("header.html");
?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"><?=$row["naiyou"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>" >
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
