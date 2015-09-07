<?php
  function connectDB($dbname, $hostname, $user, $password) {
  #  $dsn      = "mysql:dbname=$dbname;host=$hostname;charset=utf8";
  #  $dbh      = new PDO($dsn, $user, $password);
    $dsn      = "mysql:dbname=Shop;host=db;charset=utf8";
    $dbh      = new PDO($dsn, 'shopadmin', 'adminadmin');
  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    return $dbh;
}
?>
