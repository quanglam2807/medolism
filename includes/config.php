<?php
$db_host = "localhost";
$db_name    = 'test'; 
$db_username    = 'root';
$db_password    = '1';
$page_url	= 'http://localhost/medolism';
$site_name = 'Medolism';
@mysql_connect("{$db_host}", "{$db_username}", "{$db_password}") or die("Cannot connect to database");
@mysql_select_db("{$db_name}") or die("Cannot select database");
?>
