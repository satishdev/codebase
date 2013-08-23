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
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Upload Image</div>
</div>

<div id="content_wrapper" class='pad min-h'>
<form id="appl_form" method="post" action="<?php echo site_url('players/imageupload');?>" name="appl_form" enctype="multipart/form-data" >
    <ul class='wesp-form'>
        <li>
            <label for="keywords">Image</label>
            <input type="file" id="image" name="image" class="upload" value=""/>
            <div class='frm-btns' style="color:red">Supported Image types are gif, jpg, png, jpeg, bmp</div>
        </li>
        <li class='frm-btns'>
            <input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
</div>