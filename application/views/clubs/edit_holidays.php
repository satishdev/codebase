<script>
$(document).ready(function() {

   $("#appl_form").validate({
		messages: {
			name: {
				required: "Please enter holiday name"
			},
			description: {
				required: "Please enter description"
			},
			holiday_date: {
				required: "Please enter holiday date"
			}
		}
	});
	
	$('#holiday_date').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
	
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Add Holiday</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/edit_holidays');?>" name="appl_form">
<input type="hidden" id="id" name="id" value="<?php echo $h_data->id;?>"/>
	<ul class='wesp-form'>
		<li>
            <label for="name">Name</label>
            <input id="name" name="name" class="text field required" value="<?php echo $h_data->name;?>"/>
		</li>
		
		<li>
            <label for="description">Description</label>
            <textarea name="description" id="description" class="required"><?php echo $h_data->description;?></textarea>
		</li>
		<li>
            <label for="holiday_date">Holiday Date</label>
            <input id="holiday_date" class="apply_datepicker text field required" name="holiday_date" value="<?php echo $h_data->holiday_date;?>" readonly="readonly" />
		</li>
		<li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img" />
		</li>
	</ul>
</form></div>