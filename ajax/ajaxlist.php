<?
require_once('../includes/config.php'); 
$ft = $_GET['ft'];
$id = $_GET['id'];
$page = intval($_GET['page']);

// PAGE START
if ($page==1) {
$page_start = 0;
}
else {
if ($page==2) {
$page_start = 10;
}
else {
$page_start = ( $page - 1 ) * 10;
}
}

// COUNT
if ($ft==1) {
if ($id>0) {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga WHERE xxx<16 AND `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga WHERE xxx<16");
}
}
else {
if ($id>0) {
$sql_count123 = @mysql_query(" SELECT COUNT(*) FROM manga WHERE `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysql_query("SELECT COUNT(*) FROM manga");
}
}
$count123 = @mysql_fetch_array( $sql_count123 );
$pagesum = ceil($count123['0']/10);

// NOW ECHO OR ACCESS DENIED
if ($page>$pagesum) {
?>
Access Denied
<?
}
else {
if ($ft==1) {
if ($id>0) {
$sql_manga = @mysql_query("SELECT * FROM manga WHERE xxx<16 AND `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}' ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
else {
$sql_manga = @mysql_query("SELECT * FROM manga WHERE xxx<16 ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
}
else {
if ($id>0) {
$sql_manga = @mysql_query(" SELECT * FROM manga WHERE `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}' ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
else {
$sql_manga = @mysql_query("SELECT * FROM manga ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
}
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
					<img src="<? echo $manga_anhbia; ?>" class="tn123">
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
?>