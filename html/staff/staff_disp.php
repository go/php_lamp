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
        $staff_code = $_GET['staffcode'];
  
        $dsn      = 'mysql:dbname=Shop;host=db;charset=utf8';
        $user     = 'shopadmin';
        $password = 'adminadmin';
        $dbh      = new PDO($dsn, $user, $password);
  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $sql    = 'SELECT code,name FROM mst_staff WHERE code=?';
        $stmt   = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);
  
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $staff_name  = $rec['name'];
  
        $dbh = null;
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
    
    スタッフ情報参照<br>
    <br>
    スタッフコード<br>
    <?php print $staff_code; ?>
    <br>
    スタッフ名<br>
    <?php print $staff_name; ?>
    <br>
    <br>

    <form>
      <input type="button" onclick="history.back()" value="戻る">
    </form>
  </body>
</html>