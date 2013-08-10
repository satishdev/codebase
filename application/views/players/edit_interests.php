<script>
$(document).ready(function() {



       $("#appl_form").validate({
		rules: {
		   skills: {
		   required: true,
		
		   }
			
			},
		messages: {
			skills: {
				required: "Please enter Skills",
			}
			
			
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Edit Interest</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/add_interests');?>" name="appl_form">
    <ul class='wesp-form'>
	      <?php foreach($i_details as $row){?>
		  <input id="id" name="id" type="hidden" value="<?php echo $row->id;?>"/>
        <li>
            <label for="intersts_id">Intersts</label>
			<select name='intersts_id' id='intersts_id' class="field">
	 		 <?php echo selectBox('Select','interests','id,name','status="1"',$row->intersts_id); ?>
	  		</select>
        </li><li>
            <label for="skills">skills</label>
            <input id="skills" name="skills" class="text field" value="<?php echo $row->skills;?>"/>
        </li>
		<?php } ?>
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
</form>
</div>