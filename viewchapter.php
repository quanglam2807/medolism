<?
require_once('includes/config.php');
$getchap = intval($_GET['chap']);
$getmanga_id = intval($_GET['manga_id']);
$sql_viewmanga = @mysql_query("SELECT * FROM chapter WHERE manga_id='{$getmanga_id}' AND chap='{$_GET['chap']}'");
$manga = @mysql_fetch_array( $sql_viewmanga );
$sql_viewmanga2 = @mysql_query("SELECT name FROM manga WHERE id='{$getmanga_id}'");
$manga2 = @mysql_fetch_array( $sql_viewmanga2 );
if ($_GET['way']==1) {
unset($_SESSION['way']);
$_SESSION['way'] = 1;
}
if ($_GET['way']==2) {
unset($_SESSION['way']);
$_SESSION['way'] = 2;
}
if ( isset($_SESSION['way']) ) {
$way = $_SESSION['way'];
}
else {
$way = 2;
}
require_once('includes/detectlang.php');
require_once('includes/getdata.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml/">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="templates/bootstrap.min2.0.3.css" />
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$('.dropdown-toggle').dropdown()
</script>
<script>
if(url.match('^http://')){
     url = url.replace("http://","https://")
}

</script>
<title>Đọc Chapter <? echo $manga['chap'];?> - <? echo $manga2['name']; ?> - Medolism</title>
<style>
.zoom80 {
max-width: 80%;
}
.zoom {
min-width: 600px;
margin-top: 15px;
border: 7px solid black;
border-radius: 10px;
background: url("image/lazyload-spin.gif") no-repeat scroll center center #EEEEEE;
}
</style>
</head>
<body>
<body style="background: url('image/readmanga.jpg') repeat scroll 0 0 #DCDCDC; text-align:center;">
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" >
          <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a href="index" class="brand"><img src="image/logomini.png"></a>
          <div class="nav-collapse">
            <ul class="nav">
<?
$sql_chapter = @mysql_query("SELECT chap FROM chapter WHERE `manga_id`='{$getmanga_id}' ORDER by chap+0");
$sql_min = @mysql_query("SELECT chap FROM chapter WHERE `manga_id`='{$getmanga_id}' ORDER by chap+0 LIMIT 1");
$sql_max = @mysql_query("SELECT chap FROM chapter WHERE `manga_id`='{$getmanga_id}' ORDER by chap+0 DESC LIMIT 1");
$min = @mysql_fetch_array( $sql_min );
$max = @mysql_fetch_array( $sql_max );
if ($min['0']!=$getchap) {
$sql_prev = @mysql_query("SELECT chap FROM chapter WHERE `manga_id`='{$getmanga_id}' AND chap<'{$getchap}'ORDER by chap+0 DESC LIMIT 1");
$prev = @mysql_fetch_array( $sql_prev );
?>
<li><a href="viewchapter?manga_id=<? echo $getmanga_id; ?>&chap=<? echo $prev['0']; ?>">Chapter Trước</a></li>
<?
}
?>
<li><select style="height: 25px !important; line-height: 25px !important; margin-top: 7px; padding: 2px !important;" onchange="document.location.href=this.value"> 
<?
while ($chapter = @mysql_fetch_array( $sql_chapter )) {
?>			
  <option <? if ($chapter['chap']==$getchap) { echo "selected"; } ?> value="viewchapter?manga_id=<? echo $getmanga_id; ?>&chap=<? echo $chapter['chap']; ?>">Chapter <? echo $chapter['chap']; ?></option>
<?
}
?>
</select>
</li>
<?
if ($max['0']!=$getchap) {
$sql_next = @mysql_query("SELECT chap FROM chapter WHERE `manga_id`='{$getmanga_id}' AND chap>'{$_GET['chap']}'ORDER by chap+0 LIMIT 1");
$next = @mysql_fetch_array( $sql_next );
?>
<li><a href="viewchapter?manga_id=<? echo $getmanga_id; ?>&chap=<? echo $next['0']; ?>">Chapter Kế</a></li>
<?
}
?>
<li class="divider-vertical"></li>
<li><a href="viewmanga?id=<? echo $getmanga_id; ?>">Trở về trang Tổng hợp</a></li>
            </ul>
          </div>
        </div>
      </div>
   </div> 
<div style="margin-top: 65px;">
<div style="width: 500px; margin: auto; height:370px;">
<div style="width: 230px; background-color:#FFF; float:left;" class="thumbnail">
            <img src="image/fitzoom/lazyload.png" alt="">
            <div class="caption">
              <h3>Lazyload</h3>
              <p style="text-align: left; height: 100px;">Khi sử dụng chế độ này, các chức năng bổ sung như zoom sẽ được lượt bỏ, và khi bạn trượt tới đâu thì ảnh mới load tới đó. Phù hợp với các bạn có <b>tốc độ mạng chậm</b>.</p>
              <p>
<? if ($way==1) { ?>
			  <a class="btn btn-primary active" href="#">Đang sử dụng</a>  </p>
<? } else { ?>
			  <a class="btn btn-primary" href="viewchapter?manga_id=<? echo $getmanga_id; ?>&chap=<? echo $_GET['chap']; ?>&way=1">Sử dụng</a>  </p>
<? } ?>
            </div>
          </div>

<div class="thumbnail" style="width: 230px; background-color:#FFF; float:left; margin-left:10px;">
            <img alt="" src="image/fitzoom/fitandzoom.png">
            <div class="caption">
              <h3>Power Zoomer</h3>
              <p style="text-align: left; height: 100px;">Khi sử dụng chức năng này, ảnh sẽ được thu nhỏ lại bằng 80% kích cỡ màn hình để bạn không phải "kéo qua kéo lại" và có thêm chức năng zoom khi rê chuột vào ảnh .</p>
<? if ($way==2) { ?>
			  <a class="btn btn-primary active" href="#">Đang sử dụng</a>  </p>
<? } else { ?>
			  <a class="btn btn-primary" href="viewchapter?manga_id=<? echo $getmanga_id; ?>&chap=<? echo $_GET['chap']; ?>&way=2">Sử dụng</a>  </p>
<? } ?>
            </div>
          </div>
</div>
<?
if ($manga['way']==2) {
$imagerow = $manga['noidung'];
}
if ($manga['way']==1) {
include("includes/simple_html_dom.php");
$html = str_get_html($manga['noidung']);
$imagerow = ""; 
foreach($html->find('img') as $element) {
$imagerow .= $element->src . "\n";
} 
}
$idCheck = explode("\n",$imagerow);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
if (($idlan != "") && ($idlan != " ")) {
if ($way==2) {
?>
<div width="100%">
<img class="zoom zoom80" id="zoom<? echo $i; ?>" src="<? echo $idlan; ?>">
</div> 
<?
}
if ($way==1) {
?>
<div width="100%">
<img class="zoom" id="zoom<? echo $i; ?>" src="image/grey.gif" data-original="<? echo $idlan; ?>">
</div> 
<?
}
}
}
?>
</div>
<? if ($way==1) { ?>
<script src="js/jquery.lazyload.js?v=3" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($) { 
      $(function() {
          $("img.zoom").lazyload({
		      effect : "fadeIn"
		  });
      });
})
  </script> 
<? } ?>
<? if ($way==2) { ?><script src="js/ddpowerzoomer.js"></script>
<script type="text/javascript">
<?
$idCheck = explode("\n",$imagerow);
for($i=0;$i<count($idCheck);$i++){
		$idlan=$idCheck[$i];
if ( $idlan!=" " ) {
?>
jQuery(document).ready(function($){ //fire on DOM ready
 $('#zoom<? echo $i; ?>').addpowerzoom() 
})
<?
}
}
}
?>	
</script>
</body>
</html>