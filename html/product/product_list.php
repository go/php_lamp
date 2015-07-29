<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>まるまるショップ</title>
  </head>
  <body>
  <?php
    try {
      $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
      $user     = 'shopadmin';
      $password = 'adminadmin';
      $dbh      = new PDO($dsn, $user, $password);

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql  = 'SELECT code,name,price FROM mst_product';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      print '商品一覧<br><br>';

      print '<form method="post" action="product_branch.php">';

      while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
          break;
        }

        print '<input type="radio" name="procode" value="' . $rec['code'] . '">';
        print $rec['name'] . '...';
        print $rec['price'] . '円';
        print '<br>';
      }

      print '<input type="submit" name="disp" value="表示">';
      print '<input type="submit" name="add" value="追加">';
      print '<input type="submit" name="edit" value="修正">';
      print '<input type="submit" name="del" value="削除">';
      print '</form>';
    } catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしています';
      exit();
    }
  ?>
  </body>
</html>
