<?php
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
        $staff_code  = $_POST['code'];
  
        $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
        $user     = 'shopadmin';
        $password = 'adminadmin';
        $dbh      = new PDO($dsn, $user, $password);
  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $sql    = 'DELETE from mst_staff WHERE code=?';
        $stmt   = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);
  
        $dbh = null;
  
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
  
    削除しました<br>
  
    <a href="./staff_list.php">戻る</a>
  </body>
</html>

