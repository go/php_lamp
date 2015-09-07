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
        $staff_name  = $_POST['name'];
        $staff_pass  = md5($_POST['pass']);
  
        $dbh = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');
  
        $sql    = 'INSERT INTO mst_staff(name,password) VALUES(?,?)';
        $stmt   = $dbh->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $stmt->execute($data);
  
        $dbh = null;
  
        print $staff_name;
        print ' を追加しました<br>';
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>

    <a href="./staff_list.php">戻る</a>
  </body>
</html>
