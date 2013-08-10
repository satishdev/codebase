<script>
$(document).ready(function() {
       $("#appl_form").validate({
		messages: {
			name: {required: "Please enter Name"},
			description: {required: "Please enter description"}
		}
	});
});

</script>

<div id='content_header'>
	<div class='hdr-text'>Add New Gallery</div>
</div>

<div id='content_wrapper' class="pad">
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('clubs/addgallery');?>" name="appl_form">
    <ul class='wesp-form'>
        <li>
            <label for="name">Name</label>
			<input  type="text" name="name" class="text field required" id="name" />
        </li>
		
		<li>
            <label for="description">Description</label>
           	<textarea name="description" class="required" id="description"></textarea>
        </li>
		
		<!--<li>
            <label for="logo1">Logo</label>
			<input type="file" name="logo1" class="field required" id="logo1" />
        </li>		-->
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
</div>