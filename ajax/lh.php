<?
session_start();
require_once('../includes/config.php');
$lh = intval($_POST['lh']);
if (($_SESSION['user_id']) && ($_POST['manga_id']) && ($_POST['lh']) && ($lh<=2))  {
$id = intval($_POST['manga_id']);
$user_id = $_SESSION['user_id'];
if ($lh==1) {
$l = 1;
$h = 0;
}
if ($lh==2) {
$l = 0;
$h = 1;
}
$sql_query = @mysql_query("SELECT * FROM lh WHERE manga_id='{$id}' AND user_id='{$user_id}'");
if ( @mysql_num_rows( $sql_query ) <= 0 ) {
@mysql_query("INSERT INTO `lh`(`user_id`, `manga_id`, `hate`, `like`) VALUES ('{$user_id}','{$id}','{$h}','{$l}')");
}
else {
@mysql_query("UPDATE `lh` SET `hate`='{$h}',`like`='{$l}' WHERE `user_id`='{$user_id}' AND `manga_id`='{$id}'");
}
$sql_query2 = @mysql_query("SELECT COUNT(*) FROM lh WHERE manga_id='{$id}' AND `like`='1'");
$manga3 = @mysql_fetch_array( $sql_query2 );
$sql_query3 = @mysql_query("SELECT COUNT(*) FROM lh WHERE manga_id='{$id}' AND `hate`='1'");
$manga2 = @mysql_fetch_array( $sql_query3 );
$lcount = $manga3['0'];
$hcount = $manga2['0'];
$tong = $hcount + $lcount;
$pth = $hcount/$tong*100;
$ptl = $lcount/$tong*100;
$sql_query4 = @mysql_query("SELECT * FROM lh WHERE manga_id='{$id}' AND user_id='{$user_id}'");
$manga4 = @mysql_fetch_array( $sql_query4 );
if (mysql_num_rows($sql_query4) > 0) {
if ($manga4['like']==1) {
$like = 1;
$hate = 0;
}
else {
$hate = 1;
$like = 0;
}
}
?>
<div class="row" style="width: 336px; margin: 20px auto auto;">
<div style="float: left; width: 230px;">    
<div class="progress progress-striped active">
<div style="width: <? echo $ptl; ?>%;" class="bar"></div>   
</div></div>
<div style="float:left; width: 36px; margin-left: 5px; margin-right: 5px; text-align:center;"><? echo $lcount; ?></div>
<div style="float:left; width: 60px;"><a style="margin-top: -5px;" class="btn btn-primary btn-small <? if ($like==1) { echo "active"; } ?>" onclick="likehate(<? echo $id; ?>,1)">Thích</a></div>
<div style="float: left; width: 230px;">    
<div class="progress progress-striped progress-danger active">
<div style="width: <? echo $pth; ?>%;" class="bar"></div>   
</div></div>
<div style="float:left; width: 36px; margin-left: 5px; margin-right: 5px; text-align:center;"><? echo $hcount; ?></div>
<div style="float:left; width: 60px;"><a style="margin-top: -5px;" class="btn btn-danger btn-small <? if ($hate==1) { echo "active"; } ?>" onclick="likehate(<? echo $id; ?>,2)">Ghét</a></div>
</div>
<?
}
else {
echo "Access Denied";
}
?>