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
	<div class='hdr-text'>Edit News</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/edit_news');?>" name="appl_form">
<input type="hidden" id="id" name="id" value="<?php echo $n_data->id;?>"/>
	<ul class='wesp-form'>
		<li>
            <label for="headline">Headline</label>
            <input id="headline" name="headline" class="text field required" value="<?php echo $n_data->headline;?>"/>
		</li>		
		<li>
            <label for="description">Description</label>
            <textarea name="description" id="description" class="field required"><?php echo $n_data->description;?></textarea>
		</li>		
		<li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img" />
		</li>
	</ul>
</form></div>