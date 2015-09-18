<?php
  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);

  /* if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様 <br>';
  } */
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>まるまるショップ</title>
  </head>
  <body>
    お客様情報を入力してください<br>
    <form method="post" action="./shop_form_check.php">
      お名前<br>
      <input type="text" name="name"><br>

      メールアドレス<br>
      <input type="text" name="email"><br>

      郵便番号<br>
      <input type="text" name="postal_num1" style="width:50px">
      -
      <input type="text" name="postal_num2" style="width:50px">
      <br>
      
      住所<br>
      <input type="textarea" name="address" style="width:400px"><br>

      電話番号<br>
      <input type="text" name="tel_num" style="width:120px"><br>

      <input type="button" onclick"history.back()" value="戻る">
      <input type="submit" value="OK">
    </form>

  </body>
</html>
