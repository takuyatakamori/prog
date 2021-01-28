<?php
session_start();

if(
  !isset($_GET["tag"]) || $_GET["tag"]=="" 
){
  exit('ParamError');
}

//1. POSTデータ取得
$tag = $_GET["tag"];

include("funcs.php");
loginCheck();

$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM tkn_question_table WHERE tag1 LIKE '%$tag%' OR tag2 LIKE '%$tag%' OR tag3 LIKE '%$tag%'");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //$view .= "<p>".$result["indate"]."-".$result["id"]."-".$result["name"]."</p>"; //[.=]はaddしていくという意味
    $view .= '<div class="hover">';
    $view .= '<a href="detail.php?id='.$result["id"].'">';
    $view .= '<div class="date">';
    $view .= $result["indate"];
    $view .= "</div>";
    $view .= '<div class="indexTitle">';
    $view .= $result["title"];
    $view .= "</div>";
    $view .= '</a>';
    $view .= "</div>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>タグ検索結果</title>
<link href="css/reset.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/sanitize.css" rel="stylesheet">
</head>
<body id="main">
<!-- Head[Start] -->
<?php
include("header.html");
?>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="indexWrapper">
<?=$view?>
<p class="more"><a href="#" class="open-btn">more</a></p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(function() {
      var hideList = '.hover:nth-of-type(n+6)';
      $(hideList).hide();
      $('.open-btn').click(function() {
        $(hideList).toggle();
        if ($(hideList).css('display') == 'none') {
          $('.open-btn').text('more');
        } else {
          $('.open-btn').text('close');
        }
        return false;
      });

      var num = $('.hover').length;
      if (num < 6) {
        $('.open-btn').hide();
      };
    });
</script>
<!-- Main[End] -->
<?php
include("footer.html");
?>

</body>
</html>
