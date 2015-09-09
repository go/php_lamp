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
  
        $dbh    = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');
  
        $sql    = 'SELECT name,price,gazou FROM mst_product where code=?';
        $stmt   = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);
  
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name       = $rec['name'];
        $pro_price      = $rec['price'];
        $pro_gazou_name = $rec['gazou'];
       
        $dbh = null;
  
        if ($pro_gazou_name == '') {
          $disp_gazou = '';
        } else {
          $disp_gazou = '<img src="../product/gazou/' . $pro_gazou_name . '">';
        }
  
        print '<a href="shop_cartin.php?procode=' . $pro_code . '">カートに入れる</a><br><br>';
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
  
    商品情報参照<br>
    <br>
    商品コード<br>
    <?php print $pro_code; ?>
    <br>
    商品名<br>
    <?php print $pro_name; ?>
    <br>
    価格<br>
    <?php print $pro_price; ?>円
    <br>
    <?php print $disp_gazou; ?>
    <br>
    <br>
    <form>
      <input type="button" onclick"history.back()" value="戻る">
    </form>

  </body>
</html>
