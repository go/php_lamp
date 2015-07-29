<?php
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
?>
