<?
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
$sql_manga = @mysql_query("SELECT * FROM manga WHERE `congtac` LIKE '%;{$user['username']};%' OR `congtac` LIKE '{$user['username']};%' OR `congtac` LIKE '%;{$user['username']}' OR `congtac` LIKE '{$user['username']}' OR `chuxi`='{$_SESSION['user_id']}' ORDER BY chapter_id DESC");
}
else {
$sql_manga = @mysql_query("SELECT * FROM manga WHERE `id` IN (SELECT manga_id FROM `lh` WHERE `user_id`={$_SESSION['user_id']} AND `like`=1)");
}
?>
<div class="spanspecial introduce" style="width:660px;">
<ul data-tabs="tabs" class="nav nav-tabs">
<li class="firsttabs <? if ($type==1) { echo "active"; } ?>"><a href="<? if ($type==1) { echo "#"; } else { echo "manage?type=1"; }?>">Truyện đã đăng hoặc đang cộng tác</a></li>
<li class="<? if ($type==2) { echo "active"; } ?>"><a href="<? if ($type==2) { echo "#"; } else { echo "manage?type=2"; }?>">Truyện yêu thích</a></li>
</ul>
<?
?>
<div class="pill-content">
<table class="table table-striped">
<thead>
          <tr>
            <th style="width: 50px;">STT</th>
            <th>Tên truyện</th>
<?
if ($type==1) {
?>
			<th>Thao tác</th>
<?
}
?> 
			</tr>	  
</thead>
<tbody>
<?
$i = 0;
while ($manga = @mysql_fetch_array( $sql_manga )) {
$i++;
?>
<tr>
		<td style="width: 100px;"><? echo $i; ?></td>
		<td>
			<a href="viewmanga?id=<? echo $manga['id']; ?>"><? echo $manga['name']; ?></a>
		</td>
<?
if ($type==1) {
?> 
		<td>
			<a href="editmanga?id=<? echo $manga['id']; ?>" class="btn btn-small btn-primary">SỬA</a>
			
		</td>
<?
}
?>
		</tr>
<?
}
?>
</tbody>
</table>
</div>
</div>
<?
include_once('templates/sidebar_nonlist.php');
include_once('templates/footer.php');
}
?>