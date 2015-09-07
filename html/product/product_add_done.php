<?php
  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);

  if (isset($_SESSION['login']) == false) {
    print 'ログインされていません<br>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  } else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br>';
    print '<br>';
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
        $pro_name  = $_POST['name'];
        $pro_price = $_POST['price'];
        $pro_gazou_name = $_POST['gazou_name'];
  
        $dbh = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');
  
        $sql    = 'INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
        $stmt   = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_gazou_name;
        $stmt->execute($data);
  
        $dbh = null;
  
        print $pro_name;
        print ' を追加しました<br>';
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
  
    <a href="./product_list.php">戻る</a>
  </body>
</html>

