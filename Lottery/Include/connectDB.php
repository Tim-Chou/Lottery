<?php
  $db_host = "localhost";
  $db_username = "root";
  $db_password = "P@ssW0rd";
  $db_name = "savele_lottery";
  
  try{
	  $db_link = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_username, $db_password);
  }catch(PDOException $e){
	  print "資料庫連結失敗，訊息:{$e->getMessage()}<br/>";
	die();
  }
?>