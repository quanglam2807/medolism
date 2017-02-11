<?php
session_start();
require_once('includes/detectlang.php');
$colummn=1;
include_once('templates/header.php');
if (isset($_GET['name'])) {
$filename = "templates/guide/{$_GET['name']}.html";
if (file_exists($filename)) {
$name = $_GET['name'];
}
else {
$name = "login";
}
}
else {
$name = "login";
}
?>
<div class="span4">   
	<div class="well" style="padding: 8px 0; background-color: #FFF !important">
        <ul class="nav nav-list">
          <li class="nav-header">TÀI KHOẢN</li>
          <li class="<?php if ($name=="login") { echo "active"; } ?>"><a href="guide?name=login">Đăng nhập &amp; Đăng ký</a></li>
          <li class="<?php if ($name=="profile") { echo "active"; } ?>"><a href="guide?name=profile">Đổi thông tin cá nhân</a></li>
          <li class="<?php if ($name=="avatar") { echo "active"; } ?>"><a href="guide?name=avatar">Đổi ảnh đại diện (avatar)</a></li>
          <li class="<?php if ($name=="email") { echo "active"; } ?>"><a href="guide?name=email">Đổi email và mật khẩu</a></li>
        </ul>
      </div>
</div>
<div class="spanspecial">
<div style="padding:10px;" class="introduce">
<?php
include_once("templates/guide/{$name}.html");
?>
</div>
</div>
<?php
include_once('templates/footer.php');
?>