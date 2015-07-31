<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>まるまるショップ</title>
  </head>
  <body>
  <?php
    try {
      $pro_code = $_GET['procode'];

      $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
      $user     = 'shopadmin';
      $password = 'adminadmin';
      $dbh      = new PDO($dsn, $user, $password);

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql    = 'SELECT code,name,price FROM mst_product WHERE code=?';
      $stmt   = $dbh->prepare($sql);
      $data[] = $pro_code;
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $pro_name  = $rec['name'];
      $pro_price = $rec['price'];

      $dbh = null;
    } catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしています';
      exit();
    }
  ?>
  商品修正<br>
  <br>
  商品コード<br>
  <?php print $pro_code; ?>
  <br>

  <form method="post" action="product_edit_check.php">
    <input type="hidden" name="code" value="<?php print $pro_code; ?>">
    商品名<br>
    <input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>">
    <br>
    価格<br>
    <input type="text" name="price" style="width:200px" value="<?php print $pro_price; ?>">円
    <br>
    <br>

    <input type="button" onclick="hitory.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
  </body>
</html>