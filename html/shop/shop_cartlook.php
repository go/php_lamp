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
  
        if (isset($_SESSION['cart']) == true) {
          $cart = $_SESSION['cart'];
          $kazu = $_SESSION['kazu'];
          $max  = count($cart);
        } else {
          $max  = 0;
        }

        if ($max ==0) {
          print 'カートに商品が入っていません<br>';
          print '<br>';
          print '<a href="./shop_list.php">商品一覧へ戻る</a>';
          exit();
        }

        $dbh = connectDB('Shop', 'db', 'shopadmin', 'adminadmin');

        foreach($cart as $key => $val) {
          $sql     = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
          $stmt    = $dbh->prepare($sql);
          $data[0] = $val;
          $stmt->execute($data);

          $rec         = $stmt->fetch(PDO::FETCH_ASSOC);
          $pro_name[]  = $rec['name'];
          $pro_price[] = $rec['price'];

          if ($rec['gazou'] == '') {
            $pro_gazou[] = '';
          } else {
            $pro_gazou[] = '<img src="../product/gazou/' . $rec['gazou'] . '">';
          }
        }

        $dbh = null;
      } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしています';
        exit();
      }
    ?>
  
    <br>
    カートの中身<br>
    <br>
    <form method="post" action="kazu_change.php">
    <table border="1">
    <tr>
        <td>商品</td>
        <td>商品画像</td>
        <td>価格</td>
        <td>数量</td>
        <td>小計</td>
        <td>削除</td>
    </tr>
    <?php
      for ($i = 0; $i < $max; $i++) {
        print '<tr>';
        print "    <td>$pro_name[$i]</td>";
        print "    <td>$pro_gazou[$i]</td>";
        print "    <td>$pro_price[$i]円</td>";
        print "    <td><input type='text' name='kazu$i' value='$kazu[$i]'></td>";
        print "    <td>" . ($pro_price[$i] * $kazu[$i]) . "円</td>";
        print "    <td><input type='checkbox' name='sakujo$i'></td>";
        print '</tr>';
      }
    ?>
    </table>
    <input type="hidden" name="max" value="<?php print $max; ?>">
    <input type="submit" value="数量変更"><br>
    <a href="./shop_list.php">商品一覧へ戻る</a>
    </form>

  </body>
</html>
