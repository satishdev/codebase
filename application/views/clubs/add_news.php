<script>
$(document).ready(function() {

	$("#appl_form").validate({
		messages: {
			headline: {
				required: "Please enter headline"
			},
			description: {
				required: "Please enter description"
			}
		}
	});
	
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Add News</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/add_news');?>" name="appl_form">
	<ul class='wesp-form'>
		<li>
            <label for="headline">Headline</label>
            <input id="headline" name="headline" class="text field required" value=""/>
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