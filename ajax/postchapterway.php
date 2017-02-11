<?php
if ($_GET['way'] == 1) {
?>
<div style="display:none;">
<input type="radio" name="way" value="1" />
</div>
<div class="btn-group" style="margin-bottom:10px;">
    <a href="#" class="btn btn-small active">Chế Độ Đầy Đủ</a>
    <a onclick="changepostway(0)" class="btn btn-small">Chế Độ Giản Hoá</a>
</div>         
		<textarea style="background-color: white; width: 500px; height: 150px;" name="noidung"></textarea>
		<script>
		CKEDITOR.replace( 'noidung',
    {
		toolbar :
		[
			{ name: 'insert', items : [ 'Image' ] }
		]
    });
		</script>
<?php
}
else {
?>
<div style="display:none;">
<input type="radio" name="way" value="0" />
</div>
<div class="btn-group" style="margin-bottom:10px;">
    <a onclick="changepostway(1)" class="btn btn-small">Chế Độ Đầy Đủ</a>
    <a href="#" class="btn btn-small active">Chế Độ Giản Hoá</a>
</div>         
		<textarea style="background-color: white; width: 470px; height: 196px;" class="xxlarge" name="noidung"></textarea>
		<p class="help-block">Nhập link ảnh, mỗi link một dòng. </p>
<?php
}
?>