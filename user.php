<?php
session_start();
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
if (( !$_GET['username'] ) ) {
$redirect_info = "Access denied";
include_once('templates/redirect.php');
}
else {
$profilepage = 1;
$get = $_GET['username'];
$sql_profile = @mysqli_query($con, "SELECT id,username,avatar,avatartype,realname,sex,cover FROM members WHERE username='{$get}'");
$profile = @mysqli_fetch_array($sql_profile);
if (!$profile['cover']) {
$coverimg = "http://placehold.it/980x250";
}
else {
$coverimg = $profile['cover'];
}
$lang_page_title="Trang cá nhân của ".$profile['realname'];
include_once('templates/header.php');
?>
<div>
<div style="float:left; width:250px;">
<?php if ($profile['id']==$_SESSION['user_id']) { ?>
<a href="avatar" class="thumbnail" style="width: 200px; height: 200px; margin-left: 20px; background-color: rgb(255, 255, 255); margin-top: 160px;">
<?php } else { ?>
<div class="thumbnail" style="width: 200px; height: 200px; margin-left: 20px; background-color: rgb(255, 255, 255); margin-top: 160px;">
<?php } ?>
<img style="height: 200px; width: 200px;" src="<?php echo avatar($profile['avatartype'],$profile['avatar'],$profile['sex'],200); ?>">
<?php if ($profile['id']==$_SESSION['user_id']) { ?>
</a>
<?php } else { ?>
</div>
<?php } ?>
<?php if ($profile['id']==$_SESSION['user_id']) { ?>
<div style="text-align:center; margin-top: -20px;">
<a class="mangastatus mangastatus-primary" href="avatar" style="color: #FFF !important; text-decoration:none !important;">Thay đổi Avatar</a>
</div>
<?php } ?>
</div>
<div style="float: left; width:350px;">
<h3 style="margin-top: 245px;"><?php echo $profile['realname']; ?></h3>
<h5><?php echo $profile['username']; ?></h5>
<div style="margin-top: 10px;">
<div style="float: left; width: 50px;">
<font style="color:#B2B7F2;font-size:50px;font-family:'Times New Roman',serif;font-weight:bold;text-align:left;">“</font>
</div>
<div style="float: left; width: 250px;">
<font style="font-size: 13px; font-style: italic;">Tính năng đang cập nhật</font>
</div>
<div style="float: left; width: 50px;">
<font style="float:right; color:#B2B7F2;font-size:50px;font-family: 'Times New Roman',serif;font-weight:bold;text-align:left;">”</font>
</div>
</div> </div>
<div style="float: left; width: 160px;">
<div style="margin-top: 245px; margin-left: 20px;">
<?php if ($profile['id']!=$_SESSION['user_id']) { ?>
<a class="btn btn-primary" style="width:80px;"><i class="icon-plus icon-white"></i> Kết bạn</a>
<a class="btn btn-success" style="width:80px; margin-top: 10px"><i class="icon-bookmark icon-white"></i> Follow</a>
<a data-toggle="modal" href="#envelope" class="btn btn-info" style="width:80px; margin-top: 10px"><i class="icon-envelope icon-white"></i> Gửi thư</a><?php } ?></div>
</div>


<div style="float: left; width:220px;">
<?php if ($profile['id']==$_SESSION['user_id']) { ?>
<div style="float:right; margin-right: 20px; height: 50px;">
<a class="btn">THAY ĐỔI ẢNH BÌA </a>
</div>
<?php } ?>
<div style="margin-top: 255px;">
<a><b>100</b> BẠN BÈ</a>
<hr style="margin: 5px 0pt;">
<a><b>200</b> FOLLOWER</a>
<hr style="margin: 5px 0pt;">
<a><b>2040</b> FOLLOWING</a>
</div>
<hr style="margin: 5px 0pt;">
<a><b>5</b> TRUYỆN</a>
</div>
</div>
<?php if ($profile['id']!=$_SESSION['user_id']) { ?>
    <div class="modal hide fade" id="envelope">
            <div class="modal-header">
              <a data-dismiss="modal" class="close">×</a>
              <h3>Gửi thư cho <?php echo $profile['realname']; ?></h3>
            </div>
<?php if (isset($_SESSION['user_id'])) { ?>
			<form method="post" action="envelope">
            <div class="modal-body">    
			<div class="controls docs-input-sizes">  
			<textarea name="text" style="width: 521px; height: 195px;" maxlength="500"></textarea>         
			<p class="help-block charsRemaining"></p>	
			</div>
			</div>
            <div class="modal-footer">
              <a data-dismiss="modal" class="btn" href="#">Đóng</a>
              <input class="btn btn-primary" type="submit" value="Gửi" name="submit"></input>
            </div>
			</form>
<?php } else { ?>
            <div class="modal-body">    
Bạn cần phải <a href="login" class="btn btn-small btn-warning">Đăng Nhập</a> hoặc <a href="register" class="btn btn-small btn-success">Đăng Ký</a> để tiếp tục.
			</div>
            <div class="modal-footer">
              <a data-dismiss="modal" class="btn" href="#">Đóng</a>

            </div>
<?php } ?>
    </div>
<?php } ?>	
<?php
}
include_once('templates/footer.php');
?>