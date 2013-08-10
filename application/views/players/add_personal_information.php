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
			},
			
			
		}
	});
});	
</script>
<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/edit');?>" name="appl_form">
    <ol>
	          <li>
            <label for="first_name">First Name</label>
            <input id="first_name" name="first_name" class="text" value="<?php echo $u_details->first_name;?>"/>
        </li><li>
            <label for="last_name">Last Name</label>
            <input id="last_name" name="last_name" class="text" value="<?php echo $u_details->last_name;?>"/>
        </li>
		
		
		<li>
            <label for="country_id">Country</label>
			<select id="country_id" name="country_id" class="text">
                <option value="">Select</option>
				<option value="1">India</option>
            </select>
        </li>
		
        <li>
            <br/>
			<input type="submit" value="submit" name="submit" />
        </li>
    </ol>
</form></div>