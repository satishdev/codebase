<script>
$(document).ready(function() {

	$("#appl_form").validate({
		rules: {
			first_name: {
				required: true,
			},
			last_name: {
				required: true,
			}
		},
		messages: {
			first_name: {
				required: "Please enter First Name",
			},
			last_name: {
				required: "Please enter Last Name",
			}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Edit Club Info</div>
</div>
<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/edit');?>" suc_msg="Player Register: Submited Successfully.">
<input id="" name="rel" class="text" type="hidden" value="player_reg"/>
    <ul class='wesp-form'>
		<li>
            <label for="first_name">First Name</label>
            <input id="first_name" name="first_name" class="text field" value="<?php echo $u_details->first_name;?>"/>
        </li>
        <li>
            <label for="last_name">Last Name</label>
            <input id="last_name" name="last_name" class="text field" value="<?php echo $u_details->last_name;?>"/>
        </li>
		
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
    
</form>
</div>