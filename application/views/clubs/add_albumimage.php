<script>
$(document).ready(function() {
       $("#appl_form").validate({
		messages: {
			filename: {required: "Please enter image"}
		}
	});
});

</script>

<div id='content_header'>
	<div class='hdr-text'><?php echo $info->name;?> - Add Image</div>
</div>

<div id='content_wrapper' class="pad">
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('clubs/addgalleryimage');?>" name="appl_form">
<input type="hidden" name="id" id="id" value="<?php echo $info->id;?>" />
    <ul class='wesp-form'>
     		
		<li>
            <label for="description">Caption</label>
           	<textarea name="caption" class="required" id="caption"></textarea>
        </li>
		
		<li>
            <label for="logo1">Logo</label>
			<input type="file" name="filename" class="field required" id="filename" />
        </li>		
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
</div>