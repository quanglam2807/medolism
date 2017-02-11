<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml/">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if IE]>
<meta content='IE=7' http-equiv='X-UA-Compatible' />
<![endif]-->
<link href="js/btui/jquery-ui-1.8.16.custom.css" rel="Stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="templates/all.css"/>
		<link rel="stylesheet" type="text/css" href="templates/footer.css" />
		<link rel="stylesheet" type="text/css" href="templates/bootstrap.min2.0.3.css" />
	<link rel="stylesheet" type="text/css" href="templates/ui.selectmenu.css" />
	<link rel="stylesheet" type="text/css" media="screen,projection" href="templates/ui.totop.css" />
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="templates/jquery.autocomplete.css">
<link href="js/fileinput/css/enhanced.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!--[if lt IE 7 ]><script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script> <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})});</script><![endif]-->
	<script src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.ui.totop.js" type="text/javascript"></script>
<script src="js/charcount.js"></script>
<script src="jslang/<?php echo $usinglang; ?>.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/selectmenu.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/jquery.lazyload.js?v=3"></script>
<script type="text/javascript" src="js/ui.js"></script>
	<title>Medolism - <?php echo $lang_page_title; ?></title>
</head>
<body>
		<a name="top"></a>
    <div class="navbar">
    <div class="navbar-inner">
    <div class="container">
	<a class="brand" href="index"><img src="image/logomini.png"></a>
	<div class="nav-collapse">
    <ul class="nav">
    <li class="active">
    <a href="list">Đọc Truyện</a>
    </li>
    </ul>
    <ul class="nav pull-right">
<?php
if (!isset($_SESSION['user_id'])) {
?>
    <li class="dropdown" id="menu"><a class="dropdown-toggle" data-toggle="dropdown" href="#menu"><i class="icon-lock icon-white"></i> Đăng nhập <b class="caret"></b></a>
<ul class="dropdown-menu" style="width: 222px;">
<form method="post" action="login?act=do">
<li><p>Tên đăng nhập:</p></li>
<li><input type="text" style="margin-left: 15px; width: 185px;" name="username"></li>
<li><p>Mật khẩu:</p></li>
<li><input type="password" style="margin-left: 15px; width: 185px;" name="password"></li>
<li>
<div style="float:left;margin-left: 0px;">
<p style="margin-top: 7px;"><input type="checkbox" name="remember"> Ghi nhớ</p>
</div>
<div style="float:right;margin-right: 10px;"><input type="submit" style="margin-left: 15px; margin-bottom: 10px; padding: 7px;" class="btn btn-primary" value="Đăng nhập" name="submit">
</div>
</li>
<li><a href="resetpass">Bạn quên mật khẩu?</a></li>
</form>
</ul>
</li>
    <li><a href="register"><i class="icon-pencil icon-white"></i> Đăng ký</a></li>
<?php
}
else {
?>
    <li class="dropdown" id="info">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#info">
    <?php echo $user['realname']; ?>
    <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
    <li><a href="profile">Thay đổi hồ sơ</a></li>
    <li><a href="mailpass">Thay đổi mật khẩu & email</a></li>
    <li><a href="avatar">Thay đổi avatar</a></li>
	<li><a href="manage">Quản lý truyện</a></li>
    <li class="divider"></li>
    <li><a href="logout">Thoát</a></li>
    </ul>
    </li>
<?php
if ( isset($_SESSION['user_id']) ) {
?>
<a class="btn primary btn-small" href="addmanga" style="margin-left: 5px;"><i class="icon-plus"></i> Đăng Truyện</a>
<?php
}
}
?>
    </ul>
    </div>
	</div>
    </div>
    </div>
		<div id="wrapper">
			<div id="limitwidth">
				<div id="big_nav">
						<div id="head_search">
						<div style="text-align: right; padding-bottom: 5px; width: 600px;" id="chosesearch">
							<button class="btn btn-small btn-success active" value="1">Tên truyện</button>
							<button class="btn btn-small" value="2">Tác giả</button>
							<button class="btn btn-small" value="3">Thể loại</button>
							<button class="btn btn-small" value="4">Thành viên</button>
						</div>
							<div class="search_inside">
								<div id="search_box">
									<div id="search_icon"></div>
									<input type="text" name="ajaxfind" id="topmenu_search_query" search-url="ajax/headfind/1.php" search-type="1" maxlength="60" placeholder="<?php echo $lang_search_value; ?>">
								</div>
							</div>
						</div>
 </div>
<ul class="breadcrumb">
  <li><i class="icon-home"></i> <a href="index"><?php echo $lang_home; ?></a> <span class="divider">/</span></li>
  <li class="active"><?php echo $lang_page_title; ?></li>
</ul>
<?php
if (isset($error_warn) && $error_warn==1) {
?>
<div class="alert alert-error fade in">
<a class="close" href="#"  data-dismiss="alert" >&times;</a><?php echo $error_warn_in; ?>
</div>
<?php
}
if (isset($column) && $colummn==1) {
?>
<div class="row">
<?php
}
else if (!isset($profilepage)) {
?>
<div>
<?php
}
else {
?>
<div style="height: 380px; background: url('<?php echo $coverimg; ?>') no-repeat scroll 0pt 0pt rgb(255, 255, 255);" class="introduce">
<?php
}

?>
