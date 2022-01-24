<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=wine_sales;charset=utf8;host=localhost','root','root');
  // $pdo = new PDO('mysql:dbname=gs-yuta-sato_wine_sales;charset=utf8;host=mysql57.gs-yuta-sato.sakura.ne.jp','gs-yuta-sato','ryokuchi0152-yu');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM wine_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .="<p>";//.=で足し算をしていくことができる
    $view .=$result['date'].':'.$result['item'].' '.$result['quantity'].' '.$result['sum_price'];
    $view .="</p>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>売上登録表示</title>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<link rel="stylesheet" href="./css/reset.css">
<link rel="stylesheet" href="./css/bootstrap.css">
<link rel="stylesheet" href="./css/sample.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">>売上登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view?></div>
</div>
<!-- Main[End] -->

<!-- footer -->
<footer class="container text-center foot">
    <small class="text-muted">copyrights 2021 売上登録 All Righths Reserved</small>
</footer>
<!-- footer -->

</body>
</html>
