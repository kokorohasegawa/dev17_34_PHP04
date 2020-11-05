<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>login画面</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css">
</head>
<body>
  <!--header-->
  <header class="header">
    <p class="site-title"><a href="＃"><img src="images/common/logo.png" alt="G's Academy Tokyo"></a></p>
    <a href="＃" class="btn btn-cart"><img src="images/common/icon-cart.png" alt="G's Academy Tokyo"></a>
    <a href="＃" class="btn btn-menu"><img src="images/common/icon-menu.png" alt=""></a>
  </header>
  <!--end header  -->

<!-- Main[Start] -->
<form method="post" action="login_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ログイン画面</legend>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PASSWORD：<input type="text" name="lpw"></label><br>
     <input type="submit" value="ログイン">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
