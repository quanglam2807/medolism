<?php
session_start();
require_once('includes/config.php');

if (!isset($_SESSION['user_id'])) {
  $_SESSION['user_id'] = 1;
  include_once('templates/redirect.php');
} else {
  $redirect_info = "Access denied";
  include_once('templates/redirect.php');
}
?>
