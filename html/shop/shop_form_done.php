<?php
  require_once('../common/common.php');

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
      try {
        $cust_name    = $_POST['name'];
        $cust_email   = $_POST['email'];
        $cust_postal1 = $_POST['postal_num1'];
        $cust_postal2 = $_POST['postal_num2'];
        $cust_address = $_POST['address'];
        $cust_tel_num = $_POST['tel_num'];
      
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
        $max  = count($cart);
  
        $confirm_msg = '';
        $confirm_msg.= $cust_name . "様\n\nこのたびはご注文ありがとうございました\n";
        $confirm_msg.= "\n";
        $confirm_msg.= "ご注文商品\n";
        $confirm_msg.= "--------------------\n";
  
        $dbh    = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');
        $total  = 0;
        for ($i=0; $i<$max; $i++) {
          $confirm_msg.=  prepareProductInformation($dbh, $cart[$i], $kazu[$i]);
          $total = $total + (getProductPrice($dbh, $cart[$i]) * $kazu[$i]);
        }
  
        $dbh = null;
  
        $confirm_msg.= "合計 $total 円\n";
        $confirm_msg.= "送料は無料です\n";
        $confirm_msg.= "--------------------\n";
        $confirm_msg.= "\n";
        $confirm_msg.= "代金は以下の口座にお振り込み下さい\n";
        $confirm_msg.= "◯◯銀行 △△△支店 普通口座 1234567\n";
        $confirm_msg.= "入金確認が取れ次第、以下の住所に発送させていただきます\n";
        $confirm_msg.= "\n";
        $confirm_msg.= "$cust_postal1-$cust_postal2\n";
        $confirm_msg.= "$cust_address\n";
        $confirm_msg.= "\n";
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております';
        exit();
      }

      print nl2br($confirm_msg);
    ?>

    <br>
    <a href="./shop_list.php">商品画面へ</a>
  </body>
</html>

<?php
      function prepareProductInformation($dbh, $code, $suryo) {
        $msg = '';

        $sql     = 'SELECT name,price FROM mst_product WHERE code=?';
        $stmt    = $dbh->prepare($sql);
        $data[0] = $code;

        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name  = $rec['name'];
        $price = $rec['price'];

        $msg = $name . ',';
        $msg.= $price . '円 x ';
        $msg.= $suryo . '個 = ';
        $msg.= ($suryo * $price) . "円\n";

        return $msg;
      }

      function getProductPrice($dbh, $code) {
        $sql     = 'SELECT name,price FROM mst_product WHERE code=?';
        $stmt    = $dbh->prepare($sql);
        $data[0] = $code;

        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rec['price'];
      }
?>
