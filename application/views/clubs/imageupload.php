<script>
$(document).ready(function() {
       $("#appl_form").validate({
		rules: {
		   image: {required: true}
		},
		messages: {
			image: {required: "Please browse image"}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Upload Image</div>
</div>

<div id="content_wrapper" class='pad min-h'>
<form id="appl_form" method="post" action="<?php echo site_url('clubs/imageupload');?>" name="appl_form" enctype="multipart/form-data" >
    <ul class='wesp-form'>
        <li>
            <label for="keywords">Image</label>
            <input type="file" id="image" name="image" class="upload" value=""/>
        </li>		
        <li class='frm-btns'>
            <input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
</div>