<?
session_start();
$colummn=1;
require_once('includes/detectlang.php');
$lang_page_title="Danh sách truyện";
require_once('includes/config.php');
require_once('includes/getdata.php');
include_once('templates/header.php');
if ($_GET['ft']==1) {
unset($_SESSION['ft']);
$_SESSION['ft'] = 1;
}
if ($_GET['ft']==2) {
unset($_SESSION['ft']);
$_SESSION['ft'] = 2;
}
if ( isset($_SESSION['ft']) ) {
$ft = $_SESSION['ft'];
}
else {
$ft = 1;
}
if (isset($_GET['id'])) {
$id = intval($_GET['id']);
}
else {
$id = 0;
}
?>
<script>
$("[rel=tooltip]").tooltip();
</script>
<style>
.tn123 {
height:250px !important; 
width:175px !important;
background: url("image/lazyload-spin.gif") no-repeat scroll center center #EEEEEE;
}
</style>
    <div class="spanspecial">
	<div style="width:660px;">
	<div style="float:left;">
	<div class="btn-group">
    <a class="btn btn-small active" href="#">Đầy đủ</a>
    <a class="btn btn-small" href="#">Rút gọn</a>
    </div>
	</div>
	<div style="float:right; ">
	<div style="float:left; width: 90px; line-height: 30px;">Family Filter:</div>
	<div style="float:left;">
	<div class="btn-group">
<?
if ($ft==1) {
?>
	<a rel="tooltip" title="Nếu bật Family Filter, các truyện 16+ sẽ bị ẩn." class="btn btn-small btn-success active" href="#">Bật</a>
	<a rel="tooltip" title="Nếu tắt Family Filter, các truyện 16+ sẽ được hiển thị." href="list?id=<? echo $id; ?>&page=<? echo $page; ?>&ft=2" class="btn btn-small">Tắt</a>
<?
}
?>
<?
if ($ft==2) {
?>
	<a rel="tooltip" title="Nếu bật Family Filter, các truyện 16+ sẽ bị ẩn." href="list?id=<? echo $id; ?>&page=<? echo $page; ?>&ft=1" class="btn btn-small" >Bật</a>
	<a rel="tooltip" title="Nếu tắt Family Filter, các truyện 16+ sẽ được hiển thị." class="btn btn-small btn-danger active" href="#">Tắt</a>
<?
}
?>
	</div>
    </div>
	</div>
	</div>
	<div class="row" style="margin-top: 35px;">
	<div class="spanbiginfo">
<?
if ($ft==1) {
if ($id>0) {
$sql_manga = @mysql_query("SELECT * FROM manga WHERE xxx<16 AND (`cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}') ORDER BY chapter_id DESC LIMIT 0,10");
}
else {
$sql_manga = @mysql_query("SELECT * FROM manga WHERE xxx<16 ORDER BY chapter_id DESC LIMIT 0,10");
}
}
else {
if ($id>0) {
$sql_manga = @mysql_query("SELECT * FROM manga WHERE (`cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}') ORDER BY chapter_id DESC LIMIT 0,10");
}
else {
$sql_manga = @mysql_query("SELECT * FROM manga ORDER BY chapter_id DESC LIMIT 0,10");
}
}
if ($ft==1) {
if ($id>0) {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga WHERE xxx<16 AND (`cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}')");
}
else {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga WHERE xxx<16");
}
}
else {
if ($id>0) {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga WHERE `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga");
}
}
$count123 = @mysql_fetch_array( $sql_count123 );
if ($count123['0']>0) {
while ($manga = @mysql_fetch_array( $sql_manga )) {
if (!$manga['smallimg']) {
$manga_anhbia = "http://placehold.it/175x250";
}
else {
$manga_anhbia = $manga['smallimg'];
}
$sochu = strlen($manga['chuthich']);
if ($sochu>300) {
$chuthich = substr($manga['chuthich'],0,400)."........";
}
else {
$chuthich = $manga['chuthich'];
}
$sochu2 = strlen($manga['name']);
if ($sochu2>35) {
$name = substr($manga['name'],0,35)."...";
}
else {
$name = $manga['name'];
}
$sql_max = @mysql_query("SELECT chap FROM chapter WHERE id=(SELECT MAX(id) FROM chapter WHERE manga_id='{$manga['id']}')");
$max = @mysql_fetch_array( $sql_max );
$sql_chuxi = @mysql_query("SELECT id,username FROM members WHERE id='{$manga['chuxi']}'");
$chuxi = @mysql_fetch_array( $sql_chuxi );
$sql_count = @mysql_query("SELECT COUNT(*) FROM chapter WHERE manga_id='{$manga['id']}'");
$count = @mysql_fetch_array( $sql_count );
$sql_count2 = @mysql_query("SELECT COUNT(*) FROM comments WHERE manga_id='{$manga['id']}'");
$count2 = @mysql_fetch_array( $sql_count2 );
?>		
			
		<div class="introduce" style="width: 660px !important;">
			<div class="row">
			<div style="width:175px; margin-left: 30px; padding-bottom: 10px; float:left">
				<a class="thumbnail" href="viewmanga?id=<? echo $manga['id']; ?>">
					<img src="image/grey.gif" data-original="<? echo $manga_anhbia; ?>" class="tn123">
				</a>
			</div>	
			<div style="float:left; margin-left:10px;">
			<div class="page-header" style="width:455px;">
			<h3><a href="viewmanga?id=<? echo $manga['id']; ?>"><? echo $name; ?></a>  <small><? echo $manga['tacgia']; ?></small></h3>
			</div>
<?
if ($manga['status']==1) {
?>
			<font class="mangastatus mangastatus-primary">Updating: Chapter <? echo $max['0']; ?></font>
<?
}
?>	
<?
if ($manga['status']==2) {
?>
			<font class="mangastatus mangastatus-success">Complete: <? echo $count['0']; ?> chapters</font>
<?
}
?>	
<?
if ($manga['status']==3) {
?>
			<font class="mangastatus mangastatus-info">One Shot</font>
<?
}
?>
<?
if ($manga['status']==4) {
?>
			<font class="mangastatus mangastatus-inverse">Drop: <? echo $count['0']; ?> chapters</font>
<?
}
if ($manga['xxx']>=16) {
?>
			<font class="mangastatus mangastatus-danger">Dành cho lứa tuổi <? echo $manga['xxx']; ?>+</font>	
<?
}
?>
			<div class="well" style="width: 415px; height: 100px; margin-top: 20px;">
			<? echo $chuthich; ?>
			</div>
			</div>
			</div>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
</script>		
		<div class="form-actions" style="margin-top: 0 !important;">           
		<div style="clear:both;padding-bottom:5px;">
		<div style="float:left;width:250px;"><i class="icon-user"></i> <a href="user?username=<? echo $chuxi['username']; ?>"><? echo $chuxi['username']; ?></a>
		</div>
		<div style="float:left;width:250px;"><i class="icon-comment"></i> <? echo $count2['0']; ?> bình luận</div>
		<div style="float:left;"><i class="icon-picture"></i> <? echo $count['0']; ?> chapters</div>
		</div>
		<br/><b>Thể loại:</b> 
<?
$idCheck = explode(",",$manga['cats']);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
		$sql5= @mysql_query("select * from cats where id = $idlan");
		$catsne = @mysql_fetch_array( $sql5 );
if ($idlan!="") {		
?>
<? if ($i>0) {?>, <? } ?><a href="list?id=<? echo $catsne['id']; ?>"><? echo $catsne['name']; ?></a>
<?
}
}
?>
		</div>
		</div>
<?
}
}
else {
?>
<div style="text-align:center;">Chưa có truyện nào.</div>
<?
}
?>
		</div>
	</div>
<?
if ($count123['0']>10) {
?>
<script type="text/javascript">

function more(a,b,c)
{
var data2 = "ft="+a+"&page="+b+"&id="+c;
$("#more").empty().html('<div style="style="margin: auto; text-align: center;" ><a class="btn active" style="width: 620px;"><img src="image/lazyload-spin.gif"></img></a></div>');
$.ajax({
type: "GET",
url: "ajax/ajaxlist.php",
data: data2,
cache: false,
success: function(html){
$("#getmore").append(html);
}
});
$.ajax({
type: "GET",
url: "ajax/morebutton.php",
data: data2,
cache: false,
success: function(html){
$("#more").empty().append(html);
}
});
}
</script>
<div id="getmore">
</div>
<div id="more">
<div style="margin: auto; text-align: center;" ><a class="btn btn-success" style="width: 620px;" onclick="more(<? echo $ft; ?>,2,<? echo $id; ?>)">XEM THÊM</a></div>
</div>	
<?
}
?>
</div>
	<div class="span4">   
	<div style="padding: 8px 0; background-color: #FFF !important" class="well">
        <ul class="nav nav-list">
          <li class="nav-header">DANH MỤC</li>
          <li class="<? if ($id==0) { ?>active<? } ?>"><a href="list">Tất cả</a></li>
<?
$sql_cats = @mysql_query("SELECT * FROM cats");
while ($cats = @mysql_fetch_array( $sql_cats )) {
?>
          <li class="<? if ($cats['id']==$id) { ?>active<? } ?>"><a href="list?id=<? echo $cats['id']; ?>"><? echo $cats['name']; ?></a></li>
<?
}
?>
        </ul>
      </div>
	</div>
<script src="js/jquery.lazyload.js?v=3" type="text/javascript" charset="utf-8"></script>
<script src="js/list.js" type="text/javascript" charset="utf-8"></script>
<?
include_once('templates/footer.php');
?>	