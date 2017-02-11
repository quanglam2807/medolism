<?php
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
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE xxx<16 AND `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga WHERE xxx<16");
}
}
else {
if ($id>0) {
$sql_count123 = @mysqli_query($con, " SELECT COUNT(*) FROM manga WHERE `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}'");
}
else {
$sql_count123 = @mysqli_query($con, "SELECT COUNT(*) FROM manga");
}
}
$count123 = @mysqli_fetch_array( $sql_count123 );
$pagesum = ceil($count123['0']/10);

// NOW ECHO OR ACCESS DENIED
if ($page>$pagesum) {
?>
Access Denied
<?php
}
else {
if ($ft==1) {
if ($id>0) {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE xxx<16 AND `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}' ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
else {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga WHERE xxx<16 ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
}
else {
if ($id>0) {
$sql_manga = @mysqli_query($con, " SELECT * FROM manga WHERE `cats` like '%,{$id},%' OR `cats` like '{$id},%' OR `cats` like '%,{$id}' ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
else {
$sql_manga = @mysqli_query($con, "SELECT * FROM manga ORDER BY chapter_id DESC LIMIT {$page_start},10");
}
}
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
					<img src="<?php echo $manga_anhbia; ?>" class="tn123">
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
?>