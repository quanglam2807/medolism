<?php
session_start();
$colummn=1;
require_once('includes/detectlang.php');
$lang_page_title="Danh sách truyện";
require_once('includes/config.php');
require_once('includes/getdata.php');
include_once('templates/header.php');
if (isset($_GET['ft'])) {
  if ($_GET['ft']==1) {
    unset($_SESSION['ft']);
    $_SESSION['ft'] = 1;
  }
  if ($_GET['ft']==2) {
    unset($_SESSION['ft']);
    $_SESSION['ft'] = 2;
  }
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
<?php
if ($ft==1) {
?>
	<a rel="tooltip" title="Nếu bật Family Filter, các truyện 16+ sẽ bị ẩn." class="btn btn-small btn-success active" href="#">Bật</a>
	<a rel="tooltip" title="Nếu tắt Family Filter, các truyện 16+ sẽ được hiển thị." href="list?id=<?php echo $id; ?>&page=<?php echo $page; ?>&ft=2" class="btn btn-small">Tắt</a>
<?php
}
?>
<?php
if ($ft==2) {
?>
	<a rel="tooltip" title="Nếu bật Family Filter, các truyện 16+ sẽ bị ẩn." href="list?id=<?php echo $id; ?>&page=<?php echo $page; ?>&ft=1" class="btn btn-small" >Bật</a>
	<a rel="tooltip" title="Nếu tắt Family Filter, các truyện 16+ sẽ được hiển thị." class="btn btn-small btn-danger active" href="#">Tắt</a>
<?php
}
?>
	</div>
    </div>
	</div>
	</div>
	<div class="row" style="margin-top: 35px;">
	<div class="spanbiginfo">
<?php
if ($ft==1) {
if ($id>0) {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE xxx<16 AND (`cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}') ORDER BY chapter_id DESC LIMIT 0,10");
}
else {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE xxx<16 ORDER BY chapter_id DESC LIMIT 0,10");
}
}
else {
if ($id>0) {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE (`cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}') ORDER BY chapter_id DESC LIMIT 0,10");
}
else {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga ORDER BY chapter_id DESC LIMIT 0,10");
}
}
if ($ft==1) {
if ($id>0) {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE xxx<16 AND (`cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}')");
}
else {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE xxx<16");
}
}
else {
if ($id>0) {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga");
}
}
$count123 = @mysqli_fetch_array( $sql_count123 );
if ($count123['0']>0) {
while ($manga = @mysqli_fetch_array( $sql_manga )) {
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
$sql_max = @mysqli_query($con, "SELECT chap FROM chapter WHERE id=(SELECT MAX(id) FROM chapter WHERE manga_id='{$manga['id']}')");
$max = @mysqli_fetch_array( $sql_max );
$sql_chuxi = @mysqli_query($con, "SELECT id,username FROM members WHERE id='{$manga['chuxi']}'");
$chuxi = @mysqli_fetch_array( $sql_chuxi );
$sql_count = @mysqli_query($con, "SELECT COUNT(*) FROM chapter WHERE manga_id='{$manga['id']}'");
$count = @mysqli_fetch_array( $sql_count );
$sql_count2 = @mysqli_query($con, "SELECT COUNT(*) FROM comments WHERE manga_id='{$manga['id']}'");
$count2 = @mysqli_fetch_array( $sql_count2 );
?>

		<div class="introduce" style="width: 660px !important;">
			<div class="row">
			<div style="width:175px; margin-left: 30px; padding-bottom: 10px; float:left">
				<a class="thumbnail" href="viewmanga?id=<?php echo $manga['id']; ?>">
					<img src="image/grey.gif" data-original="<?php echo $manga_anhbia; ?>" class="tn123">
				</a>
			</div>
			<div style="float:left; margin-left:10px;">
			<div class="page-header" style="width:455px;">
			<h3><a href="viewmanga?id=<?php echo $manga['id']; ?>"><?php echo $name; ?></a>  <small><?php echo $manga['tacgia']; ?></small></h3>
			</div>
<?php
if ($manga['status']==1) {
?>
			<font class="mangastatus mangastatus-primary">Updating: Chapter <?php echo $max['0']; ?></font>
<?php
}
?>
<?php
if ($manga['status']==2) {
?>
			<font class="mangastatus mangastatus-success">Complete: <?php echo $count['0']; ?> chapters</font>
<?php
}
?>
<?php
if ($manga['status']==3) {
?>
			<font class="mangastatus mangastatus-info">One Shot</font>
<?php
}
?>
<?php
if ($manga['status']==4) {
?>
			<font class="mangastatus mangastatus-inverse">Drop: <?php echo $count['0']; ?> chapters</font>
<?php
}
if ($manga['xxx']>=16) {
?>
			<font class="mangastatus mangastatus-danger">Dành cho lứa tuổi <?php echo $manga['xxx']; ?>+</font>
<?php
}
?>
			<div class="well" style="width: 415px; height: 100px; margin-top: 20px;">
			<?php echo $chuthich; ?>
			</div>
			</div>
			</div>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
</script>
		<div class="form-actions" style="margin-top: 0 !important;">
		<div style="clear:both;padding-bottom:5px;">
		<div style="float:left;width:250px;"><i class="icon-user"></i> <a href="user?username=<?php echo $chuxi['username']; ?>"><?php echo $chuxi['username']; ?></a>
		</div>
		<div style="float:left;width:250px;"><i class="icon-comment"></i> <?php echo $count2['0']; ?> bình luận</div>
		<div style="float:left;"><i class="icon-picture"></i> <?php echo $count['0']; ?> chapters</div>
		</div>
		<br/><b>Thể loại:</b>
<?php
$idCheck = explode(",",$manga['cats']);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
		$sql5= @mysqli_query($con, "select * from cats where id = $idlan");
		$catsne = @mysqli_fetch_array( $sql5 );
if ($idlan!="") {
?>
<?php if ($i>0) {?>, <?php } ?><a href="list?id=<?php echo $catsne['id']; ?>"><?php echo $catsne['name']; ?></a>
<?php
}
}
?>
		</div>
		</div>
<?php
}
}
else {
?>
<div style="text-align:center;">Chưa có truyện nào.</div>
<?php
}
?>
		</div>
	</div>
<?php
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
<div style="margin: auto; text-align: center;" ><a class="btn btn-success" style="width: 620px;" onclick="more(<?php echo $ft; ?>,2,<?php echo $id; ?>)">XEM THÊM</a></div>
</div>
<?php
}
?>
</div>
	<div class="span4">
	<div style="padding: 8px 0; background-color: #FFF !important" class="well">
        <ul class="nav nav-list">
          <li class="nav-header">DANH MỤC</li>
          <li class="<?php if ($id==0) { ?>active<?php } ?>"><a href="list">Tất cả</a></li>
<?php
$sql_cats = @mysqli_query($con, "SELECT * FROM cats");

while ($cats = @mysqli_fetch_array( $sql_cats )) {
?>
          <li class="<?php if ($cats['id']==$id) { ?>active<?php } ?>"><a href="list?id=<?php echo $cats['id']; ?>"><?php echo $cats['name']; ?></a></li>
<?php
}
?>
        </ul>
      </div>
	</div>
<script src="js/jquery.lazyload.js?v=3" type="text/javascript" charset="utf-8"></script>
<script src="js/list.js" type="text/javascript" charset="utf-8"></script>
<?php
include_once('templates/footer.php');
?>
