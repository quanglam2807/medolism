<?php
session_start();
require_once('includes/config.php');

if (!isset($_SESSION['user_id'])) {
  $_SESSION['user_id'] = 1;
  header('Location: '.$page_url);
} else {
  $redirect_info = "Access denied";
  header('Location: '.$page_url);
}
?>
