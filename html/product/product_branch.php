<?php
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
