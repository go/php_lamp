<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>まるまるショップ</title>
  </head>
  <body>
  <?php
    try {
      $pro_code  = $_POST['code'];
      $pro_name  = $_POST['name'];
      $pro_price = $_POST['price'];
      $pro_gazou_name_old = $_POST['gazou_name_old'];
      $pro_gazou_name = $_POST['gazou_name'];

      $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
      $user     = 'shopadmin';
      $password = 'adminadmin';
      $dbh      = new PDO($dsn, $user, $password);

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql    = 'UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
      $stmt   = $dbh->prepare($sql);
      $data[] = $pro_name;
      $data[] = $pro_price;
      $data[] = $pro_gazou_name;
      $data[] = $pro_code;
      $stmt->execute($data);

      $dbh = null;

      if ($pro_gazou_name_old != $pro_gazou_name) {
        if ($pro_gazou_name_old != '') {
          unlink('./gazou/'.$pro_gazou_name_old);
        }
      }

      print '修正しました<br>';
    } catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしています';
      exit();
    }
  ?>

  <a href="product_list.php">戻る</a>
  </body>
</html>

