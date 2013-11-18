<?php
session_start();
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
$lang_page_title="Licenses & Sources";
include_once('templates/header.php');
include_once('templates/licenses.php');
include_once('templates/footer.php');
?>