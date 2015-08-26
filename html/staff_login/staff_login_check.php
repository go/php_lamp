<?php
  $staff_name = $_POST["name"];
  $staff_pass = $_POST["pass"];

  $staff_pass = md5($staff_pass);

  $dsn        = 'mysql:dbname=Shop;host=db;charset=utf8';
  $user       = 'shopadmin';
  $password   = 'adminadmin';
  $dbh        = new PDO($dsn, $user, $password);

  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql    = 'SELECT code FROM mst_staff WHERE name=? AND password=?';
  $stmt   = $dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  $dbh = null;

  if ($rec == false) {
    print 'スタッフ名かパスワードが間違っています<br>';
    print '<a href="staff_login.html">戻る</a>';
  } else {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['staff_code'] = $rec['code'];
    $_SESSION['staff_name'] = $staff_name;
    header('Location:staff_top.php');
    exit();
  }
?>
