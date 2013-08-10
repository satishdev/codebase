<script>
$(document).ready(function() {
	$("#appl_form").validate({
		messages: {
			name: {
				required: "Please enter facility name"
			},
			description: {
				required: "Please enter description"
			}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Add New Facility</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/add_facilities');?>" name="appl_form">
	<ul class='wesp-form'>
		<li>
            <label for="name">Facility Name</label>
            <input type="text" name="name" id="name" value="" class="text field required" />
		</li>
		<li>
            <label for="description">Description</label>
            <textarea name="description" id="description" class="field required"></textarea>
		</li>
		<li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img" />
		</li>
	</ul>
</form></div>