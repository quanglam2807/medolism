<?
require_once('../includes/config.php');
require_once('../includes/getdata.php');
$page = $_GET['page'];
$id = $_GET['manga_id'];
$rows_per_page = 5;
if ($page==1) {
$page_start = 0;
}
else {
if ($page==2) {
$page_start = 5;
}
else {
$page_start = ( $page - 1 ) * $rows_per_page - $rows_per_page;
}
}
$sql_chapter5 = @mysql_query("SELECT * FROM comments WHERE `manga_id`='{$id}' ORDER BY id LIMIT {$page_start},{$rows_per_page}");
$sql_chapter6 = @mysql_query("SELECT id FROM comments WHERE `manga_id`='{$id}' ORDER BY id");
$number_of_page = ceil ( @mysql_num_rows( $sql_chapter6 ) / $rows_per_page ); 
if (@mysql_num_rows( $sql_chapter6 ) <= 0) {
?>
<p class="liense" style="padding-bottom: 10px;">Chưa có bình luận nào cả.</p>
<?
}
else {
while ($chapter5 = @mysql_fetch_array( $sql_chapter5 )) {
$user_id11= $chapter5['user_id'];
$noidung = $chapter5['noidung'];
$sql_memdata2 = @mysql_query("SELECT username,avatar,avatartype,sex FROM members WHERE id='{$user_id11}'");
$user2 = @mysql_fetch_array( $sql_memdata2 );
?>
<div class="row">
<div style="float: left; width: 180px; margin-top: -5px; text-align: center;">
<div style="width: 130px; margin-left: 35px;">
<a href="user?username=<? echo $user2['username']; ?>" class="thumbnail" ><img src="<? echo avatar($user2['avatartype'],$user2['avatar'],$user2['sex'],130); ?>"></a>
<a href="user?username=<? echo $user2['username']; ?>" style="line-height: 35px;"><? echo $user2['username']; ?></a>
</div>
</div>
<div style="float:left; width: 480px; margin-top:-5px; ">
<div style="min-height: 70px;" class="well">
<p><? echo $chapter5['noidung']; ?></p>
</div>
<div style="margin-top: -10px;">
<div style="float:right;">
<input type="submit" value="Trả lời" class="btn btn-primary btn-small" name="submit">
</div>
<div style="float:left;">
<? echo $chapter5['ngaydang']; ?>
</div>
</div>
</div>
</div>
<hr>
<?
}
include_once("../includes/pagination.php");
}
?>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
</script>