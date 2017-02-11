<?php
  $db_host = 'localhost';
  $db_name = 'test';
  $db_username = 'root';
  $db_password = '123456';
  $page_url	= 'http://localhost:8080/medolism';
  $site_name = 'Medolism';
  $con = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die("Cannot connect to database");
?>
