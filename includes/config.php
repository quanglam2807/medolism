<?php
  $db_host = getenv('DB_HOST') ?: 'localhost';
  $db_name = getenv('DB_NAME') ?: 'test';
  $db_username = getenv('DB_USER') ?: 'root';
  $db_password = getenv('DB_PASS') ?: '123456';
  $page_url = getenv('PAGE_URL') ?: 'http://localhost:8080/medolism';
  $site_name = 'Medolism';
  $con = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die("Cannot connect to database");
  mysqli_set_charset($con, 'utf8');
?>
