<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品編集</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/jquery.bxslider.css">
</head>
<body id="main">
  <!--header-->
  <header class="header">
    <p class="site-title"><a href="../index.php"><img src="../images/common/logo.png" alt="G's Academy Tokyo"></a></p>
  </header>
  <!-- end header-->

<?php
session_start();

// 0.  ログインチェック
session_start();
require_once('../funcs.php');
loginCheck();

// 管理者権限かどうかを確認。
require_once('../funcs.php');
KanriCheck();

// GETで値を受信
$id=$_GET['id'];
// echo $code;

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM ec_table WHERE id=".$id);
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  $result=$stmt->fetch();
}
?>

<body class="cms">


  <div class="outer">

    <!--商品本情報-->
    <div class="wrapper wrapper-cms">
      <!--商品選択フォーム-->
      <form action="update.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">
        <!--商品情報-->
        <p class="cms-thumb"><img src="../img/<?=$result['fname']?>" width="200"></p>
        <dl class="cms-list">
          <dt>画像</dt>
          <dd><input type="file" name="fname" class="cms-item" accept="image/*" value="../img/<?=$result['fname']?>"></dd>
          <dt>商品名</dt>
          <dd><input type="text" name="item" placeholder="商品名を入力" class="cms-item" value="<?=$result['item']?>"></dd>
          <dt>金額</dt>
          <dd><input type="text" name="value" placeholder="金額を入力" class="cms-item" value="<?=$result['value']?>"></dd>
          <dt>カテゴリー（１〜５）</dt>
          <dd><input type="text" name="category" placeholder="カテゴリーを入力" class="cms-item" value="<?=$result['category']?>"></dd>
          
          <dt>商品紹介文</dt>
          <dd><textarea name="description" id="" cols="30" rows="10" class="cms-item"><?=$result['description']?></textarea></dd>

         </dl>
         <input type="hidden" name="id"  value="<?=$result['id']?>">
        <!--end 商品情報-->
        <ul class="btn-list btn-list__cms">
          <li class="">
            <a href="item_list.php" class="btn-back">戻る</a>
          </li>
          <li class="btn-calculate">
            <input type="submit" id="btn-update" value="登録">
          </li>
        </ul>
        </form>
        <!--end 商品選択フォーム-->
    </div>
    <!--end 商品本情報-->
  </div>

  <!--footer-->
  <footer class="footer">
    <div class="wrapper wrapper-footer">

      <div class="footer-widget__long">
        <p><a href="#"><img src="../images/common/logo.png" alt="g's academy tokyo"></a></p>
      </div>

      <div class="footer-widget">
        <ul class="nav-footer">
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
          <li class="nav-footer__item"><a href="#">Category</a></li>
        </ul>
      </div>

      <div class="footer-widget">
        <ul class="nav-footer">
          <li class="nav-footer__item"><a href="#">G's Academy??</a></li>
          <li class="nav-footer__item"><a href="#">Contact Us</a></li>
          <li class="nav-footer__item"><a href="#">Cart</a></li>
          <li class="nav-footer__item"><a href="#">Member Page</a></li>
        </ul>
      </div>

      <div class="footer-widget">
        <ul class="social-list">
          <li class="social-item"><a href="#"><img src="../images/common/facebook.png" alt=""></a></li>
          <li class="social-item"><a href="#"><img src="../images/common/instagram.png" alt=""></a></li>
          <li class="social-item"><a href="#"><img src="../images/common/twitter.png" alt=""></a></li>
        </ul>
      </div>

    </div>
    <p class="copyrights"><small>Copyrights G’s Academy Tokyo All Rights Reserved.</small></p>
  </footer>
  <!--end footer-->




<script src="http://code.jquery.com/jquery-3.0.0.js"></script>
<script>
//---------------------------------------------------
//画像サムネイル表示
//---------------------------------------------------
// アップロードするファイルを選択
$('input[type=file]').change(function() {
  //選択したファイルを取得し、file変数に格納
  var file = $(this).prop('files')[0];
  // 画像以外は処理を停止
  if (!file.type.match('image.*')) {
    // クリア
    $(this).val(''); //選択されてるファイルを空にする
    $('.cms-thumb > img').html(''); //画像表示箇所を空にする
    return;
  }
  // 画像表示
  var reader = new FileReader(); //1
  reader.onload = function() {   //2
    $('.cms-thumb > img').attr('src', reader.result);
  }
  reader.readAsDataURL(file);    //3
});
</script>
</body>
</html>


