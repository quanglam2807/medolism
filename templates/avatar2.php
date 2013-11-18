<link href="js/fileinput/css/enhanced.css" rel="stylesheet">
<ul class="nav nav-tabs" data-tabs="tabs">
<li class="firsttabs"><a href="profile"><? echo $lang_profile; ?></a></li>
<li><a href="mailpass"><? echo $lang_emailandpass; ?></a></li>
<li class="active"><a href="avatar"><? echo $lang_avatar; ?></a></li>
</ul>
<div class="pill-content">
<div class="active">
<div class="form-horizontal" >
<div class="control-group">
<label><? echo $lang_current_avatar; ?>:</label>
<div class="controls docs-input-sizes"> 
<ul>
<a>
<img src="<? echo $user['avatar']; ?>" class="thumbnail" style="max-height: 200px;">
</a>
</ul>
</div>
</div>
</div>
<div class="form-horizontal" >
<div class="page-header">
<h2 style="padding-left: 10px;"><? echo $lang_avatar_step." 2: "; ?>
<small><? echo $lang_edit_avatar; ?></small>
</h2> 
</div>
<link href="js/jquery.cropzoom.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.cropzoom.js"></script>
<script type="text/javascript">// <![CDATA[
    $(document).ready(function(){
       var cropzoom = $('#crop_container').cropzoom({
            width:550,
            height:450,
            bgColor: '#CCC',
            enableRotation:true,
            enableZoom:true,
            zoomSteps:10,
            rotationSteps:10,
            selector:{        
			  showPositionsOnDrag:false,
			  showDimetionsOnDrag:false,
              centered:true,
              borderColor:'blue',
              borderColorHover:'red',
			  aspectRatio: true,
              w:100,
              h:100,
			  maxWidth:300,
			  maxHeight:300
            },
            image:{
                source:'<?php echo $cropimagesrc; ?>',
                    width: 720,
                    height:540,
                    minZoom:50,
                    maxZoom:150,
                    startZoom:0
            }
        });
        $('#crop').click(function(){ 
            cropzoom.send('resize_and_crop.php','POST',{},function(rta){
                $('#result_image').find('img').remove();
                var img = $('<img />').attr('src',rta);
                $('#result_image').append(img);
				var cropped_src = "<input type='hidden' name='new_avatar' value='"+rta+"' />";
				$('#result_image').append(cropped_src);
            });
        });
        $('#restore').click(function(){
            cropzoom.restore();
        });
   });
// ]]&gt;</script>
<div id="crop_container" style="margin-left: 215px;"></div>
<div id="movement" style="float:left;width:80px"></div>
<div id="sliders" style="float:left;width:400px">
<div id="zoom" style="margin:15px 0 0 0"></div>
<div id="rot" style="clear:both"></div>
</div>
<div class="form-actions">                                                                                                          
<a id="crop" class="btn btn-primary" href="#avatar_modal" data-toggle="modal"><? echo $lang_finish_avatar; ?></a>                                      
<button id="restore" class="btn"><? echo $lang_restore_image; ?></button> 
<div id="avatar_modal" class="modal hide fade">
<div class="modal-header">
<a class="close" data-dismiss="modal">&times;</a>
<h3><? echo $lang_confirm; ?></h3>
</div>
<form action="avatar?act=successful&&avaway=1" method="post">
<div class="modal-body">
<p>
<div id="result_image" style="text-align: center;">
</div>
</p>  
<p><? echo $lang_avatar_guide; ?></p>
</div>
<div class="modal-footer">
<a data-dismiss="modal" class="btn" href="#"><? echo $lang_cancel; ?></a>
<input type="submit" name="submit" value="<? echo $lang_confirm; ?>" class="btn btn-primary" ></input>
</div>
</form>
</div>
</div>                                                             
</div>
</div>
</div>
<script src="js/fileinput/js/enhance.min.js" type="text/javascript"></script>
<script src="js/fileinput/js/fileinput.jquery.js" type="text/javascript"></script>
<script>
    $('#file').customFileInput({
        button_position : 'right'
    });
</script>