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
      $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
      $user     = 'shopadmin';
      $password = 'adminadmin';
      $dbh      = new PDO($dsn, $user, $password);

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql  = 'SELECT code,name FROM mst_staff';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      print 'スタッフ一覧<br><br>';

      print '<form method="post" action="staff_branch.php">';

      while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
          break;
        }

        print '<input type="radio" name="staffcode" value="' . $rec['code'] . '">';
        print $rec['name'];
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

  <br>
  <a href="../staff_login/staff_top.php">トップメニューへ</a>
  </body>
</html>
