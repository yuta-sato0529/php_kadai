<!DOCTYPE html>
<html lang="js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>売上登録</title>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="bootstrap-datepicker.ja.min.js"></script>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="./css/sample.css">
</head>
<body>

<!-- header -->
<header>
    <a href="select.php">売上一覧</a>
</header>
<!-- header -->
<!-- main -->
<main>
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>売上登録フォーム</legend>
     <label>日付：<input type="text" class="form-control" name="date" id="date_sample"></label><br>
     <label>商品名：<select class="form-select parent" aria-label="Default select example" name="item">
            <!-- 商品選択 -->
            <option value="" class="msg" selected>商品選択</option>
                <option value="VO2019">ヴァンデオラージュ・ルージュ2019</option>
                <option value="cidre2020">シードル2020</option>
                <option value="mba2021">マスカット・ベーリーAロゼ2021</option>
            </select>
            <br>
     <label>価格（税抜）：<select class="form-select children" aria-label="Default select example" name="price_taxex" disabled>
        <option value="" selected></option>
           <option value="2500" data-val="VO2019">2500</option>
           <option value="2000" data-val="cidre2020">2000</option>
           <option value="2300" data-val="mba2021">2300</option>
        </select>
        <br>
     <label>数量：<select class="form-select" aria-label="Default select example" name="quantity">
            <!-- 商品選択 -->
            <option selected>数量選択</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
            </select><br>
     <label>合計金額：<input type="text" name="sum_price"></label><br>
     <label>顧客年代：<select class="form-select" aria-label="Default select example" name="cus_sex">
            <!-- 年代選択 -->
            <option selected>年代</option>
                <option>20代以下</option>
                <option>30代</option>
                <option>40代</option>
                <option>50代</option>
                <option>60代以上</option>
            </select><br>
     <label>顧客性別：<select class="form-select" aria-label="Default select example" name="cus_sex">
            <!-- 性別選択 -->
            <option selected>性別</option>
                <option>男性</option>
                <option>女性</option>
            </select><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>

<script>
    // 日付選択
    $('#date_sample').datepicker({
        format:'yyyy/mm/dd'
    });
    // 商品選択
    var $children = $('.children'); 
    var original = $children.html();
        //商品名のselect要素が変更になるとイベントが発生
        $('.parent').change(function() {
            var val1 = $(this).val();
            //削除された要素をもとに戻すため.html(original)を入れておく
            $children.html(original).find('option').each(function() {
                var val2 = $(this).data('val'); //data-valの値を取得
            
                //valueと異なるdata-valを持つ要素を削除
                if (val1 != val2) {
                    $(this).not(':first-child').remove();
                }
            });
        
            //商品側のselect要素が未選択の場合、都道府県をdisabledにする
            if ($(this).val() == "") {
              $children.attr('disabled', 'disabled');
            } else {
                $children.removeAttr('disabled');
            }
        
        });

</script>

</main>
<!-- main -->
<!-- footer -->
<footer class="container text-center foot">
    <small class="text-muted">copyrights 2021 売上登録 All Righths Reserved</small>
</footer>
<!-- footer -->


</body>
</html>