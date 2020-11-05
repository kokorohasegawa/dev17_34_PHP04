<?php
session_start();
$lid=$_POST['lid'];
$lpw=$_POST['lpw'];

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE u_id=:u_id AND u_pw=:u_pw");
$stmt->bindValue(':u_id',$lid,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_pw',$lpw,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$result="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  $result=$stmt->fetch();
  echo $result['id'];
  echo $result['u_id'];
  }

if($result['id']!=""){
  $_SESSION['chk_ssid']=session_id();
  $_SESSION['u_name']=$result['u_name'];
  $_SESSION['kanri_flg']=$result['kanri_flg'];
  // header("Location:select.php");
}else{
  header("Location:login.php");
}

// 管理者権限と一般権限で画面を分岐
if($result['kanri_flg']==0){
  header("Location:index.php");
}else{
  header("Location:index.php");
}
?>


</body>
</html>
