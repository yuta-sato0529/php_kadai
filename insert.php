<?php

$date = $_POST['date'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$price_taxex = $_POST['price_taxex'];
$sum = $_POST['sum_price'];
$cus_age = $_POST['cus_age'];
$cus_sex = $_POST['cus_sex'];

// 2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs-yuta-sato_wine_sales;charset=utf8;host=mysql57.gs-yuta-sato.sakura.ne.jp','gs-yuta-sato','ryokuchi0152-yu');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}


// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO wine_table(id, date, item, price_taxex, quantity, sum_price, cus_age, cus_sex)
  VALUES(NULL, :date, :item, :price_taxex, :quantity, :sum_price, :cus_age, :cus_sex)"
);

// 4. バインド変数を用意。ハッカーによって直接データ書き換えをさせないため
$stmt->bindValue(':date', $date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':item', $item, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price_taxex', $price_taxex, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $quantity, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $sum_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $cus_age, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $cus_sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
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
