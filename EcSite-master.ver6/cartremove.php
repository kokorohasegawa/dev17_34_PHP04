<?php
session_start();

// 0.  ログインチェック
session_start();
require_once('funcs.php');
loginCheck2();

//1.GETでidを取得
if(!isset($_GET["id"]) || $_GET["id"]==""){
  exit("ErrorParam!");
}

//GET受信
$id = intval($_GET["id"]);

//SESSION削除
unset($_SESSION["cart"][$id]);

//cart.phpへリダイレクト
header("Location: cart.php");
exit;

?>
