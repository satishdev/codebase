
<div id='content_header'>
	<div class='hdr-text'>Update Image</div>
</div>

<div id='content_wrapper' class="pad">
<?php if($rows){?>
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teams/editgalleryimage');?>" name="appl_form">
<input type="hidden" name="img_id" id="img_id" value="<?php echo $rows->img_id;?>" />
<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $rows->cat_id;?>" />
<input type="hidden" name="tid" id="tid" value="<?php echo $t_details->id;?>" />
    <ul class='wesp-form'>
     		<li><div align="center">
				<img src="<?php echo base_url().'uploads/'.$rows->thumbnail; ?>" alt="" />
			</div></li>
		<li>
            <label for="description">Caption</label>
           	<textarea name="caption" class="required" id="caption"><?php echo $rows->caption;?></textarea>
        </li>
			
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
<?php } ?>
</div>