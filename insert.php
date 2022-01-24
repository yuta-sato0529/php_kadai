<?php
// エラー表示コード
// ini_set("display_errors", 1);
// error_reporting(E_ALL);


$buy_date = $_POST['buy_date'];
$item = $_POST['item'];
$price_taxex = $_POST['price_taxex'];
$quantity = $_POST['quantity'];
$sum_price = $_POST['sum_price'];
$cus_age = $_POST['cus_age'];
$cus_sex = $_POST['cus_sex'];

// 2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=wine_sales;charset=utf8;host=localhost','root','root');
  // $pdo = new PDO('mysql:dbname=gs-yuta-sato_wine_sales;charset=utf8;host=mysql57.gs-yuta-sato.sakura.ne.jp','gs-yuta-sato','ryokuchi0152-yu');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO wine_table(id, buy_date, item, price_taxex, quantity, sum_price, cus_age, cus_sex )
  VALUES(NULL, :buy_date, :item, :price_taxex, :quantity, :sum_price, :cus_age, :cus_sex )"
);

// 4. バインド変数を用意。ハッカーによって直接データ書き換えをさせないため
$stmt->bindValue(':buy_date', $buy_date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':item', $item, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price_taxex', $price_taxex, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sum_price', $sum_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cus_age', $cus_age, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cus_sex', $cus_sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location:index.php');

}
?>
