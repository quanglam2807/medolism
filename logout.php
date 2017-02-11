<?php
session_start();
require_once('includes/config.php');

if ( !$_SESSION['user_id'] ) {
  $redirect_info = $lang_not_yet_login;
  header('Location: '.$page_url);
} else {
  unset($_SESSION['user_id']);
  $_SESSION = array();
  session_destroy();
  if (isset($_COOKIE['user_id'])) {
   setcookie('user_id', '', time()-60*60*24*100, '/');
 }

 if (!isset($_SESSION['user_id'])) {
   $redirect_info = $lang_succesful_logout;
   header('Location: '.$page_url);
 } else {
   $redirect_info = $lang_fail_logout;
   header('Location: '.$page_url);
 }
}
?>
