<script>
$(document).ready(function() {

       $("#appl_form").validate({
			rules: {
			   company: {
			   required: true,
			
			   },
				 designation: {
				   required: true,
				   }
				,
				 location: {
				   required: true,
				   }
				   
				},
			messages: {
				company: {
					required: "Please enter Company",
				},
				designation: {
					required: "Please enter designation",
				},
				location: {
					required: "Please enter location",
				}
				
				
			}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Add Work Experience</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/add_working_expierence');?>" name="appl_form" >
    <ul class='wesp-form'>	    
        <li>
            <label for="company">Company Name</label>
            <input id="company" name="company" class="text field" value=""/>
        </li>
		<li>
            <label for="exp_skill">Designation</label>
            <input id="designation" name="designation" class="text field" value=""/>
        </li>
		<li>
            <label for="exp_skill">Location </label>
            <input id="location" name="location" class="text field" value=""/>
        </li>
		<li>
            <label for="exp_skill">Time Period From </label>
			 <select name='month' id='month' class="text field" style="width:80px; margin-right:20px;">
	 		 <?php echo month_select(0); ?>
	  		</select>&nbsp;&nbsp;&nbsp;&nbsp;<select name='year' id='year' class="field" style="width:80px;">
	 		 <?php echo year_select(0); ?>
	  		</select>
        </li>
		<li>
            <label for="exp_skill">Time Period To</label>
			 <select name='month2' id='month2' class="text field" style="width:80px; margin-right:20px;">
	 		 <?php echo month_select(0); ?>
	  		</select>&nbsp;&nbsp;&nbsp;&nbsp;<select name='year2' id='year2' class="field" style="width:80px;">
	 		 <?php echo year_select(0); ?>
	  		</select>
        </li>
		<li>
            <label for="exp_skill">Additional Notes</label>
			<textarea id="additional_notes" name="additional_notes"></textarea>
        </li>
		<!--<li>
            <label for="exp_skill">Expierence Skill</label>
            <input id="exp_skill" name="exp_skill" class="text field" value=""/>
        </li>
		 <li>
            <label for="from_date">From</label>
            <select name='from_date' id='from_date' class="text field">
	 		 <?php //echo year_select(0); ?>
	  		</select>
        </li><li>
            <label for="to_date">To</label>
             <select name='to_date' id='to_date' class="field">
	 		 <?php //echo year_select(0); ?>
	  		</select>
        </li>-->
		<!-- <li>
            <label for="till_now">till_now</label>
            <input id="till_now" name="till_now" class="text" value=""/>
        </li>-->
		<!--<li>
            <label for="country_id">Country</label>
           <select name='country_id' id='country_id' class="field">
	 		 <?php //echo selectBox('Select','country','id,name','status="1"','1'); ?>
	  		</select>
        </li>
		 <li>
            <label for="first_name">State</label>
            <input id="state" name="state" class="text field" value=""/>
        </li><li>
            <label for="zip">Zip Code</label>
            <input id="zip" name="zip" class="text field" value=""/>
        </li>-->
		<li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
</form>
</div>