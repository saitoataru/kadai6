<?php
//1. POSTデータ取得
$name   = $_POST['name'];
$email  = $_POST['email'];
$content = $_POST['content'];

//2. DB接続します
//*** function化する！  *****************
try {
    $pdo=new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage() ); }

//３．データ登録SQL作成
$sql="INSERT INTO gs_an_table ( id, name, email, content, indate ) VALUES( NULL, :name, :email, :content, sysdate() )";

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
//SQL実行
$flag = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: index.php');
    exit();
}
