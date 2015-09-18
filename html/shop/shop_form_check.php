<?php
  session_start();
  session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>まるまるショップ</title>
  </head>
  <body>
    <?php
      $cust_name    = $_POST['name'];
      $cust_email   = $_POST['email'];
      $cust_postal1 = $_POST['postal_num1'];
      $cust_postal2 = $_POST['postal_num2'];
      $cust_address = $_POST['address'];
      $cust_tel_num = $_POST['tel_num'];

      $okflag = true;
      $msg = '';
    
      if ($cust_name == "") {
        $msg.= 'お名前が入力されていません<br>';
        $okflag = false;
      } else {
        $msg.= 'お名前<br>';
        $msg.= $cust_name;
        $msg.= '<br>';
        $msg.= '<br>';
      }
    
      if (preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/', $cust_email) == 0) {
        $msg.= 'メールアドレスをきちんと入力してください<br>';
        $okflag = false;
      } else {
        $msg.= 'メールアドレス<br>';
        $msg.= $cust_email;
        $msg.= '<br>';
        $msg.= '<br>';
      }
    
      if (preg_match('/^[0-9]+$/', $cust_postal1) == 0 || preg_match('/^[0-9]+$/', $cust_postal2) == 0) {
        $msg.= '数字以外の文字が入力されています<br>';
        $okflag = false;
      } else {
        $msg.= '郵便番号<br>';
        $msg.= $cust_postal1;
        $msg.= ' - ';
        $msg.= $cust_postal2;
        $msg.= '<br>';
        $msg.= '<br>';
      }
  
      if ($cust_address == '') {
        $msg.= '住所が入力されていません<br>';
        $okflag = false;
      } else {
        $msg.= '住所<br>';
        $msg.= $cust_address;
        $msg.= '<br>';
        $msg.= '<br>';
      }

      if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/', $cust_tel_num) == 0) {
        $msg.= '電話番号が正しくありません<br>';
        $okflag = false;
      } else {
        $msg.= '電話番号<br>';
        $msg.= $cust_tel_num;
        $msg.= '<br>';
        $msg.= '<br>';
      }

      print $msg;
      postVars($okflag, $cust_name, $cust_email, $cust_postal1, $cust_postal2, $cust_address, $cust_tel_num);
    ?>

  </body>
</html>

<?php
  function postVars($okflag, $cust_name, $cust_email, $cust_postal1, $cust_postal2, $cust_address, $cust_tel_num) {
    print '<br><br>';

    if ($okflag == true) {
      print '<form method="post" action="./shop_form_done.php">';
      print '<input type="hidden" name="name" value="' . $cust_name . '">';
      print '<input type="hidden" name="email" value="' . $cust_email . '">';
      print '<input type="hidden" name="postal_num1" value="' . $cust_postal1 . '">';
      print '<input type="hidden" name="postal_num2" value="' . $cust_postal2 . '">';
      print '<input type="hidden" name="address" value="' . $cust_address . '">';
      print '<input type="hidden" name="tel_num" value="' . $cust_tel_num . '">';
      print '<input type="button" onclick"history.back()" value="戻る">';
      print '<input type="submit" value="OK">';
      print '</form>';
    } else {
      print '<form>';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '</form>';
    }
  }
?>
