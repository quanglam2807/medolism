<form class="form-horizontal" action="editchapter?id=<?php echo $chapter_id; ?>&act=do" method="post">
<div class="control-group">                  
	<label>Số chap mới <font style="color:red;">*</font>:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="chap" value="<?php echo $chap; ?>"> 
		<p class="help-block">Chỉ chấp nhận số.</p>
	</div>                                                                  
</div>   
<div class="control-group">                  
	<label>Thông tin bổ sung:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="bosung" maxlength="255" value="<?php echo $bosung; ?>"> 
		<p class="help-block charsRemaining"></p>
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Link Download:</label>              
	<div class="controls docs-input-sizes">                  
		<input type="text" name="download" value="<?php echo $download; ?>"> 
	</div>                                                                  
</div>  
<div class="control-group">                  
	<label>Nội dung chapter <font style="color:red;">*</font>:</label>      
<div class="controls docs-input-sizes">
<?php
if ( $_POST['way'] ) {
$detectway = $_POST['way'];
}
else {
if ( !$_GET['way']) {
$detectway = $_POST['way'];
}
else {
$detectway = $_GET['way'];
}
}
if (( !$_GET['way']) && ( !$_POST['way'])) {
$detectway = $way;
}
if ($detectway==1) {
?>
<div style="display:none;">
<input type="radio" name="way" value="1" checked>
</div>
<div class="btn-group" style="margin-bottom:10px;">
    <a href="#" class="btn btn-small active">Chế Độ Đầy Đủ</a>
    <a href="editchapter?way=2&&id=<?php echo $chapter_id; ?>" class="btn btn-small">Chế Độ Giản Hoá</a>
</div>  
		<script type="text/javascript" src="js/myscript.js"></script>
		<textarea style="background-color: white; width: 500px; height: 300px;" id="noidung" name="noidung" class="ckeditor"><?php echo $noidung; ?></textarea>
</div>
<?php
}
if ($detectway==2){
?>
<div style="display:none;">
<input type="radio" name="way" value="2" checked>
</div>
<div class="btn-group" style="margin-bottom:10px;">
    <a href="editchapter?way=1&&id=<?php echo $chapter_id; ?>" class="btn btn-small">Chế Độ Đầy Đủ</a>
    <a href="#" class="btn btn-small active">Chế Độ Giản Hoá</a>
</div>         
		<textarea style="background-color: white; width: 470px; height: 196px;" class="xxlarge" name="noidung"><?php echo $noidung; ?></textarea>
		<p class="help-block">Nhập link ảnh, mỗi link một dòng. </p>
<?php
}
?>
</div>
<div class="control-group">                  
	<label>Bạn có muốn xóa?</label>              
	<div class="controls docs-input-sizes">  
			<input type="radio" name="delete" value="1"> Có<br>
			<input type="radio" name="delete" value="0" checked> Không<br>
	</div>                                                                  
</div>
<div class="form-actions">                                                                                                      
<input type="submit" name="submit" class="btn btn-primary" value="Gửi">                                         
<button type="reset" class="btn">Hủy</button>                                                                         
</div> 
</form> 