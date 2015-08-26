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
        $staff_name  = $_POST['name'];
        $staff_pass  = $_POST['pass'];
  
        $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
        $user     = 'shopadmin';
        $password = 'adminadmin';
        $dbh      = new PDO($dsn, $user, $password);
  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $sql    = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
        $stmt   = $dbh->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $data[] = $staff_code;
        $stmt->execute($data);
  
        $dbh = null;
  
        print '修正しました<br>';
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
  
    <a href="staff_list.php">戻る</a>
  </body>
</html>
