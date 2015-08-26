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

      $sql    = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
      $stmt   = $dbh->prepare($sql);
      $data[] = $pro_code;
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $pro_name  = $rec['name'];
      $pro_gazou_name = $rec['gazou'];

      $dbh = null;

      if ($pro_gazou_name == '') {
        $disp_gazou = '';
      } else {
        $disp_gazou = '<img src="./gazou/'.$pro_gazou_name.'">';
      }
    } catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしています';
      exit();
    }
  ?>
  商品削除<br>
  <br>
  商品コード<br>
  <?php print $pro_code; ?>
  <br>
  商品名<br>
  <?php print $pro_name; ?>
  <br>
  <?php print $disp_gazou; ?>
  <br>
  この商品を削除してよろしいですか?<br>
  <br>

  <form method="post" action="product_delete_done.php">
    <input type="hidden" name="code" value="<?php print $pro_code; ?>">
    <input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name; ?>">

    <input type="button" onclick="hitory.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
  </body>
</html>
