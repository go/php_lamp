<?php
  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);

  if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様 <br>';
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>まるまるショップ</title>
  </head>
  <body>
  <?php
    try {
      $dbh = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');

      $sql  = 'SELECT code,name,price FROM mst_product';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      print '商品一覧<br><br>';

      while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
          break;
        }

        print '<a href="./shop_product.php?procode=' . $rec['code'] . '">';
        print $rec['name'] . '---';
        print $rec['price'] . '円';
        print '</a>';
        print '<br>';
      }

      print '<br>';
      print '<a href="shop_cartlook.php">カートを見る</a><br>';
    } catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしています';
      exit();
    }
  ?>

  </body>
</html>
