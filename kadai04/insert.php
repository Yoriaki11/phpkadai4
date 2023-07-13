<?php
//1. POSTデータ取得
$name   = $_POST['name'];
$url  = $_POST['url'];
$naiyou = $_POST['naiyou'];
$point    = $_POST['point']; //追加されています

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table(name,url,point,naiyou,indate)VALUES(:name,:url,:point,:naiyou,sysdate());');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':point', $point, PDO::PARAM_INT);
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
