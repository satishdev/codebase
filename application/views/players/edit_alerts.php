<script>
$(document).ready(function() {
       $("#appl_form").validate({
		rules: {
		   keywords: {
		   required: true,
		
		   }
			
			},
		messages: {
			keywords: {
				required: "Please enter keywords",
			}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Edit Alert</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/add_alerts');?>" name="appl_form">
    <ul class='wesp-form'>
	   <?php foreach($a_details as $row){?>
	   <input id="id" name="id" type="hidden" value="<?php echo $row->id;?>"/>
        <li>
            <label for="keywords">keywords</label>
            <input id="keywords" name="keywords" class="text field" value="<?php echo $row->keywords;?>"/>
        </li><li>
            <label for="sports_id">Sports</label>
			<select name='sports_id' id='sports_id' class="field">
	 		 <?php echo selectBox('Select','sports','id,name','status="1"',$row->spid); ?>
	  		</select>
        </li>
		 <?php } ?>
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
</form>
</div>