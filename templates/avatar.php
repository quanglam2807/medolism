<ul class="nav nav-tabs" data-tabs="tabs">
<li class="firsttabs"><a href="profile"><? echo $lang_profile; ?></a></li>
<li><a href="mailpass"><? echo $lang_emailandpass; ?></a></li>
<li class="active"><a href="avatar"><? echo $lang_avatar; ?></a></li>
</ul>
<div class="pill-content">
<div class="active">
<div class="form-horizontal">
<div class="control-group">
<label><? echo $lang_current_avatar; ?>:</label>
<div class="controls docs-input-sizes"> 
<ul class="media-grid">
<a>
<img src="<? echo avatar($user['avatartype'],$user['avatar'],$user['sex'],200); ?>" class="thumbnail" style="max-height: 200px;">
</a>
</ul>
</div>
</div>
</div>
<form class="form-horizontal" action="avatar?avaway=1" method="post" enctype="multipart/form-data">
<div class="page-header">
<h2 style="padding-left: 10px;"> <? echo $lang_avatar_step." 1: "; ?>
<small><? echo $lang_upload_avatar; ?></small>
</h2>
</div>
<div class="control-group">
<label><? echo $lang_avatar_select_file; ?></label>
<div class="controls docs-input-sizes"> 
<input type="file" name="file" id="file" />
<p class="help-block"><? echo $lang_avatar_upload_help; ?></p>
</div>
</div>
<div class="form-actions">
<input type="submit" name="file" value="<? echo $lang_avatar_upload; ?>" class="btn btn-primary"/>
</div>
</form>
</div>
</div>
</div>