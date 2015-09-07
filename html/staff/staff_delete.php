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
        $staff_code = $_GET['staffcode'];
  
        $dbh = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');
  
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
    スタッフ削除<br>
    <br>
    スタッフコード<br>
    <?php print $staff_code; ?>
    <br>
    スタッフ名<br>
    <?php print $staff_name; ?>
    <br>
    このスタッフを削除してよろしいですか?<br>
    <br>
  
    <form method="post" action="staff_delete_done.php">
      <input type="hidden" name="code" value="<?php print $staff_code; ?>">
  
      <input type="button" onclick="hitory.back()" value="戻る">
      <input type="submit" value="OK">
    </form>
  </body>
</html>
