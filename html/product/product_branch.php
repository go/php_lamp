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

  if (isset($_POST['disp']) == true) {
    if (isset($_POST['procode']) == false) {
      header('Location:product_ng.php');
      exit();
    }
    $pro_code = $_POST['procode'];
    header('Location:product_disp.php?procode=' . $pro_code);
    exit();
  }

  if (isset($_POST['add']) == true) {
    header('Location:product_add.php');
    exit();
  }

  if (isset($_POST['edit']) == true) {
    if (isset($_POST['procode']) == false) {
      header('Location:product_ng.php');
      exit();
    }
    $pro_code = $_POST['procode'];
    header('Location:product_edit.php?procode=' . $pro_code);
    exit();
  }

  if (isset($_POST['del']) == true) {
    if (isset($_POST['procode']) == false) {
      header('Location:product_ng.php');
      exit();
    }
    $pro_code = $_POST['procode'];
    header('Location:product_delete.php?procode=' . $pro_code);
    exit();
  }
?>
