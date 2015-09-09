<?php
  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);

  if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様 <br>';
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
        $pro_code = $_GET['procode'];
  
        if (isset($_SESSION['cart']) == true) {
          $cart = $_SESSION['cart'];
          $kazu = $_SESSION['kazu'];
          if (in_array($pro_code, $cart) == true) {
            print 'その商品はすでにカートに入っています<br>';
            print '<a href="./shop_list.php">商品一覧に戻る</a>';
            exit();
          }
        }

        $cart[] = $pro_code;
        $kazu[] = 1;
        $_SESSION['cart'] = $cart;
        $_SESSION['kazu'] = $kazu;
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
  
    カートに追加しました<br>
    <br>
    <a href="./shop_list.php">商品一覧に戻る</a>

  </body>
</html>
