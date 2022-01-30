<?php
// エラー表示コード
ini_set("display_errors", 1);
error_reporting(E_ALL);


$buy_date = $_POST['buy_date'];
$item = $_POST['item'];
$price_taxex = $_POST['price_taxex'];
$quantity = $_POST['quantity'];
$sum_price = $_POST['sum_price'];
$cus_age = $_POST['cus_age'];
$cus_sex = $_POST['cus_sex'];
$id = $_POST['id'];

// 2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
    "UPDATE wine_table
    SET buy_date=:buy_date , item=:item , price_taxex=:price_taxex , quantity=:quantity, sum_price=:sum_price, cus_age=:cus_age, cus_sex=:cus_sex  
    WHERE id=:id "
);

// 4. バインド変数を用意。ハッカーによって直接データ書き換えをさせないため
$stmt->bindValue(':buy_date', $buy_date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':item', $item, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price_taxex', $price_taxex, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sum_price', $sum_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cus_age', $cus_age, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':cus_sex', $cus_sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT
// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．select.phpへリダイレクト
  redirect('select.php');

}
?>