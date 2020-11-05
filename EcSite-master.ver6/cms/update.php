<?php
session_start();

// 0.  ログインチェック
session_start();
require_once('../funcs.php');
loginCheck2();

// 管理者権限かどうかを確認。
require_once('../funcs.php');
KanriCheck();

//----------------------------------------------------
//１．入力チェック(受信確認処理追加)
//----------------------------------------------------
//商品名 受信チェック:item
if(!isset($_POST['item'])
  ||
  $_POST['item']==""){
    // 商品名が入力されていない場合
    exit('PrameError!!item!');
  }

//金額 受信チェック:value
if(!isset($_POST['value'])
  ||
  $_POST['value']==""){
    // 金額が入力されていない場合
    exit('PrameError!!value!');
  }

//商品紹介文 受信チェック:description
if(!isset($_POST['description'])
  ||
  $_POST['description']==""){
    // 商品紹介文が入力されていない場合
    exit('PrameError!!description!');
  }

  //商品紹介文 受信チェック:description
  if(!isset($_POST['category'])
  ||
  $_POST['category']==""){
    // 商品紹介文が入力されていない場合
    exit('PrameError!!category!');
  }

//ファイル受信チェック※$_FILES["******"]["name"]の場合
if(!isset($_FILES['fname']['name'])
  ||
  $_FILES['fname']['name']==""){
    // 商品紹介文が入力されていない場合
    exit('PrameError!!fname!');
  }

//----------------------------------------------------
//２. POSTデータ取得
//----------------------------------------------------
$id=$_POST['id']; //id
$fname = $_FILES['fname']['name'];   //File名
$item = $_POST['item'];   //商品名
$value = $_POST['value'];   //価格(数字：intvalを使う)
$description = $_POST['description'];   //商品紹介文
$category=$_POST['category'];//カテゴリー


//1-2. FileUpload処理
$upload = "../img/"; //画像アップロードフォルダへのパス
//アップロードした画像を../img/へ移動させる記述↓
if(move_uploaded_file($_FILES['fname']['tmp_name'], $upload.$fname)){
  //FileUpload:OK
} else {
  //FileUpload:NG
  echo "Upload failed";
  echo $_FILES['upfile']['error'];
}

//----------------------------------------------------
//３. DB接続します(エラー処理追加)
//----------------------------------------------------
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//----------------------------------------------------
//４．データ登録SQL作成
//----------------------------------------------------
$stmt = $pdo->prepare("UPDATE
                            ec_table
                        SET
                            item=:item,
                            value=:value,
                            description=:description,
                            fname=:fname,
                            indate=sysdate(),
                            category=:category
                        WHERE
                            id=:id;
                    ");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);              
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':value', $value, PDO::PARAM_INT); //数値
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_INT);
$status = $stmt->execute();

//----------------------------------------------------
//５．データ登録処理後
//----------------------------------------------------
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．item_list.phpへリダイレクト
  header("Location: item_list.php");
  exit;
}
?>