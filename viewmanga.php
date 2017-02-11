<?php
session_start();
$colummn=1;
require_once('includes/detectlang.php');
require_once('includes/config.php');
require_once('includes/getdata.php');
$id = intval($_GET['id']);
$sql_viewmanga = @mysqli_query($con, "SELECT * FROM manga WHERE id='{$id}'");
$manga = @mysqli_fetch_array( $sql_viewmanga );
			$chuxi = $manga['chuxi'];
			$congtac = $manga['congtac'];
$no_per = 0;
$idCheck = explode(";",$congtac);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
if ($no_per==0) {
		if (!isset($_SESSION['user_id'])) {
			$no_per = 0;
		}
		else if (( $_SESSION['user_id'] == $chuxi  ) || ( $user['username'] == $idlan ) || ( $user['level'] == 10)) {
    		$no_per = 1;
		}
		else {
			$no_per = 0;
		}
}
}
$lang_page_title = $manga['name'];
if ($manga['tenkhac']) {
$lang_page_title .= " [".$manga['tenkhac']."]";
}
$sql_chuxi = @mysqli_query($con, "SELECT id,username FROM members WHERE id='{$manga['chuxi']}'");
$chuxi = @mysqli_fetch_array( $sql_chuxi );
if (( !$_GET['id'] ) || ( !$manga['name'] )) {
$redirect_info = "Access denied";
include_once('templates/redirect.php');
}
else {
$_SESSION['previous'] = "viewmanga?id={$id}";
include_once('templates/header.php');
?>
<div class="spanspecial">
<div class="introduce" style="width:660px;">
<div style="width:650px;" class="page-header">
			<h2 style="padding-left:10px;"><?php echo $manga['name']; ?> <small><?php echo $manga['tacgia']; ?><?php if ($no_per==1) { ?><a class="btn btn-large btn-primary" href="editmanga?id=<?php echo $manga['id']; ?>" style="float:right; ">CHỈNH SỬA</a><?php } ?></small></h2>
</div>
<div style="width:336px; margin-left:154px;" class="thumbnail">
            <img style="width:336px; height:480px;" src="<?php
if (!$manga['bigimg']) {
echo "http://placehold.it/336x480";
}
else {
echo $manga['bigimg'];
} ?>">
</div>
<?php
$user_id = $_SESSION['user_id'];
$sql_query2 = @mysqli_query($con, "SELECT COUNT(*) FROM lh WHERE manga_id='{$id}' AND `like`='1'");
$manga3 = @mysqli_fetch_array( $sql_query2 );
$sql_query3 = @mysqli_query($con, "SELECT COUNT(*) FROM lh WHERE manga_id='{$id}' AND `hate`='1'");
$manga2 = @mysqli_fetch_array( $sql_query3 );
$lcount = $manga3['0'];
$hcount = $manga2['0'];
$tong = $hcount + $lcount;
if ($hcount>0) {
$pth = $hcount/$tong*100;
}
else {
$pth = 0;
}
if ($lcount>0) {
$ptl = $lcount/$tong*100;
}
else {
$ptl = 0;
}
$sql_query4 = @mysqli_query($con, "SELECT * FROM lh WHERE manga_id='{$id}' AND user_id='{$user_id}'");
$manga4 = @mysqli_fetch_array( $sql_query4 );
if (mysqli_num_rows($sql_query4) > 0) {
if ($manga4['like']==1) {
$like = 1;
$hate = 0;
}
if ($manga4['hate']==1) {
$hate = 1;
$like = 0;
}
}
?>
<script type="text/javascript">
function likehate(a,b)
{
<?php if (!$_SESSION['user_id']) { ?>
$("#needtologin").empty().html('<div class="alert fade in" style="width:336px; margin:auto;"><a href="#" data-dismiss="alert" class="close">×</a>Bạn cần phải <a href="login">đăng nhập</a> hoặc <a href="register">đăng ký</a> để tiếp tục.</div>');
<?php } else { ?>
var data5 = 'manga_id='+a+'&lh='+b;
$("#likehate").empty().html('<div style="width: 50%; margin: 15px auto auto;" class="progress progress-info progress-striped active"><div style="width: 100%" class="bar"></div></div>');
$.ajax({
type: "POST",
url: "ajax/lh.php",
data: data5,
cache: false,
success: function(html){
$("#likehate").empty().append(html);
}
});
<?php } ?>
}
</script>
<div id="likehate">
<div class="row" style="width: 336px; margin: 20px auto auto;">
<div style="float: left; width: 230px;">
<div class="progress progress-striped active">
<div style="width: <?php echo $ptl; ?>%;" class="bar"></div>
</div></div>
<div style="float:left; width: 36px; margin-left: 5px; margin-right: 5px; text-align:center;"><?php echo $lcount; ?></div>
<div style="float:left; width: 60px;"><a style="margin-top: -5px;" class="btn btn-primary btn-small <?php if ($like==1) { echo "active"; } ?>" onclick="likehate(<?php echo $id; ?>,1)">Thích</a></div>
<div style="float: left; width: 230px;">
<div class="progress progress-striped progress-danger active">
<div style="width: <?php echo $pth; ?>%;" class="bar"></div>
</div></div>
<div style="float:left; width: 36px; margin-left: 5px; margin-right: 5px; text-align:center;"><?php echo $hcount; ?></div>
<div style="float:left; width: 60px;"><a style="margin-top: -5px;" class="btn btn-danger btn-small <?php if ($hate==1) { echo "active"; } ?>" onclick="likehate(<?php echo $id; ?>,2)">Ghét</a></div>
</div>
</div>
<div id="needtologin">
</div>
<div style="padding:10px;">
<?php if ($manga['tenkhac']) { ?>
<div style="padding-top:5px; color:green;">
<b>Tên khác:</b> <?php echo $manga['tenkhac']; ?>
</div>
<?php } ?>
<div style="padding-top:5px; color: #0090ff;">
<b>Tác giả:</b> <?php echo $manga['tacgia']; ?>
</div>
<div style="padding-top:5px; color: #8AB800">
<b>Tình trạng:</b>
<?php
if ($manga['status']==1) {
?>
Updating
<?php
}
?>
<?php
if ($manga['status']==2) {
?>
Completed
<?php
}
?>
<?php
if ($manga['status']==3) {
?>
One Shot
<?php
}
?>
<?php
if ($manga['status']==4) {
?>
Drop
<?php
}
?>
</div>
<div style="padding-top:5px; color: #660066;">
<b>Nguồn/Nhóm dịch: </b><?php echo $manga['nguon']; ?>
</div>
<div style="padding-top:5px; color: #FF0000;">
<b>Ngày đăng: </b><?php echo $manga['ngaydang']; ?>
</div>
<div style="padding-top:5px; color: #ff9600;">
<b>Thể loại:</b>
<?php
$idCheck2 = explode(",",$manga['cats']);
for($i=0;$i<count($idCheck2);$i++){
		$idlan2=$idCheck2[$i];
		$sql5= @mysqli_query($con, "select * from cats where id = $idlan2");
		$catsne = @mysqli_fetch_array( $sql5 );
if ($idlan2!="") {
?>
<?php if ($i>0) {?>,<?php } ?> <a href="list?id=<?php echo $catsne['id']; ?>"><?php echo $catsne['name']; ?></a>
<?php
}
}
?>
</div>
<div style="padding-top:5px; color: #FF3399;">
<b>Đăng bởi:</b> <a href="user?username=<?php echo $chuxi['username']; ?>"><?php echo $chuxi['username']; ?></a>
<?php
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
$sql_congtac = @mysqli_query($con, "SELECT id,username FROM members WHERE BINARY username='{$idlan}'");
$ctn = @mysqli_fetch_array( $sql_congtac );
if (($idlan!="") && ($idlan!=" ")) {
if ( @mysqli_num_rows( $sql_congtac ) > 0 ) {
?>
, <a href="user?username=<?php echo $ctn['username']; ?>"><?php echo $ctn['username']; ?></a>
<?php
}
}
}
?>
</div>
</div>
<div class="well" style="margin-top: 10px; width:600px; margin-left: 10px;">
<?php echo $manga['chuthich']; ?>
</div>
<style>
.insidechap {
overflow: auto;
max-height: 400px;
}
</style>
<script type="text/javascript">
function orderby(a,b)
{
var data = 'act='+a+'&id='+b;
$("#myDiv").empty().html('<div style="margin: auto auto 25px; width: 50%;" class="progress progress-info progress-striped active"><div style="width: 100%" class="bar"></div></div>');
$.ajax({
type: "GET",
url: "ajax/refreshchapterlist.php",
data: data,
cache: false,
success: function(html){
$("#myDiv").empty().append(html);
}
});
}
</script>
<div id="myDiv">
<p style="padding-left: 20px;"><b>Sắp xếp:</b> <font style="color: #DA4F49; font-weight: bold;">LỚN NHẤT TRƯỚC</font> || <a onclick="orderby(2,<?php echo $id; ?>)">NHỎ NHẤT TRƯỚC</a> || <a onclick="orderby(3,<?php echo $id; ?>)">MỚI CẬP NHẬT</a></p>
<table class="table table-striped" style="margin-bottom:0 !important; width: 640px;">
        <thead>
          <tr>
            <th style="width: 100px;">Chapter</th>
            <th style="width: 300px;">Thông tin</th>
            <th style="width: 120px;">Ngày đăng</th>
<?php if ($no_per == 1) { ?>
            <th style="width: 70px;">Download</th>
			<th style="width: 50px;">...</th>
<?php }
else { ?>
            <th style="width: 120px;">Download</th>
<?php } ?>
          </tr>
        </thead>
</table>
<div class="insidechap">
<table class="table table-striped" style="width:640px; margin-bottom:0 !important; ">
        <tbody>
<?php
$sql_chapter = @mysqli_query($con, "SELECT * FROM chapter WHERE `manga_id`='{$id}' ORDER BY chap DESC");
while ($chapter = @mysqli_fetch_array( $sql_chapter )) {
$sochu = strlen($chapter['bosung']);
if ($sochu>45) {
$chuthich = substr($chapter['bosung'],0,30)."...";
}
else {
$chuthich = $chapter['bosung'];
}
?>
          <tr>
            <td style="width: 100px;"><a href="viewchapter?manga_id=<?php echo $id; ?>&chap=<?php echo $chapter['chap']; ?>">Chapter <?php echo $chapter['chap']; ?></a></td>
            <td style="width: 300px;"><?php echo $chuthich ?></td>
            <td style="width: 120px;"><?php echo $chapter['ngaydang']; ?></td>
<?php if ($no_per == 1) { ?>
            <td style="width: 70px;">
<?php } else { ?>
            <td style="width: 120px;">
<?php } ?>
<?php
if (!$chapter['download']) {
echo "Không có";
}
else {
?>
<a href="<?php echo $chapter['download']; ?>">Download</a>
<?php
}
 ?>
		</td>
<?php if ($no_per == 1) { ?>
		<td>
		<a href="editchapter?id=<?php echo $chapter['id']; ?>" class="btn btn-primary btn-small">SỬA</a>
		</td>
<?php } ?>
          </tr>
<?php
}
?>
        </tbody>
      </table>
</div>
</div>
<hr>
<div style="width: 650px; padding:10px; margin-top: -18px;  text-align: center;"><a class="btn btn-primary btn-small" href="addchapter?id=<?php echo $id; ?>" style="">ĐĂNG CHAPTER MỚI</a>
</div>

</div>
</div>

<?php
include_once('templates/sidebar_nonlist.php');
include_once('templates/footer.php');
}

?>
