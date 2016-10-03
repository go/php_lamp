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
      $staff_code  = $_POST['code'];
      $staff_name  = $_POST['name'];
      $staff_pass  = $_POST['pass'];
    
      if ($staff_name == "") {
        print 'スタッフ名が入力されていません<br>';
      } else {
        print 'スタッフ名: ';
        print $staff_name;
        print '<br>';
      }
    
      if ($staff_pass == '') {
        print 'パスワードが入力されていません<br>';
      }
  
      if ($staff_name == '' || $staff_pass == '') {
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
      } else {
        $staff_pass = md5($staff_pass);
        print '上記のように修正します<br>';
        print '<form method="post" action="staff_edit_done.php">';
        print '<input type="hidden" name="code" value="'.$staff_code.'">';
        print '<input type="hidden" name="name" value="'.$staff_name.'">';
        print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
        print '<br>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="OK">';
        print '</form>';
      }
    ?>
  </body>
</html>
