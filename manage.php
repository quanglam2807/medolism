<?php
session_start();
$colummn=1;
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
$lang_page_title="Quản lý truyện";
if ($_GET['type']) {
$type = $_GET['type'];
}
else {
$type = 1; 
}
if ( !$_SESSION['user_id'] )
{ 
$redirect_info = "Bạn cần phải đăng nhập để tiếp tục";
$custom_previous = "login";
$_SESSION['previous'] = "manage";
require_once('templates/redirect.php');
}
else {
include_once('templates/header.php');
if ($type==1) {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE `congtac` LIKE '%;{$user['username']};%' OR `congtac` LIKE '{$user['username']};%' OR `congtac` LIKE '%;{$user['username']}' OR `congtac` LIKE '{$user['username']}' OR `chuxi`='{$_SESSION['user_id']}' ORDER BY chapter_id DESC");
}
else {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE `id` IN (SELECT manga_id FROM `lh` WHERE `user_id`={$_SESSION['user_id']} AND `like`=1)");
}
?>
<div class="spanspecial introduce" style="width:660px;">
<ul data-tabs="tabs" class="nav nav-tabs">
<li class="firsttabs <?php if ($type==1) { echo "active"; } ?>"><a href="<?php if ($type==1) { echo "#"; } else { echo "manage?type=1"; }?>">Truyện đã đăng hoặc đang cộng tác</a></li>
<li class="<?php if ($type==2) { echo "active"; } ?>"><a href="<?php if ($type==2) { echo "#"; } else { echo "manage?type=2"; }?>">Truyện yêu thích</a></li>
</ul>
<?php
?>
<div class="pill-content">
<table class="table table-striped">
<thead>
          <tr>
            <th style="width: 50px;">STT</th>
            <th>Tên truyện</th>
<?php
if ($type==1) {
?>
			<th>Thao tác</th>
<?php
}
?> 
			</tr>	  
</thead>
<tbody>
<?php
$i = 0;
while ($manga = @mysqli_fetch_array( $sql_manga )) {
$i++;
?>
<tr>
		<td style="width: 100px;"><?php echo $i; ?></td>
		<td>
			<a href="viewmanga?id=<?php echo $manga['id']; ?>"><?php echo $manga['name']; ?></a>
		</td>
<?php
if ($type==1) {
?> 
		<td>
			<a href="editmanga?id=<?php echo $manga['id']; ?>" class="btn btn-small btn-primary">SỬA</a>
			
		</td>
<?php
}
?>
		</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
<?php
include_once('templates/sidebar_nonlist.php');
include_once('templates/footer.php');
}
?>