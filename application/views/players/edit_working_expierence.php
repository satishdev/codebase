<script>
$(document).ready(function() {

       $("#appl_form").validate({
			rules: {
			   company: {
			   	required: true,
			   },
				exp_skill: {
					required: true,
				}
			},
			messages: {
				company: {
					required: "Please enter Company Name",
				},
				exp_skill: {
					required: "Please enter Expierence Skill",
				},
			}
		});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Add Educational Info</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/add_working_expierence');?>" name="appl_form" >
    <ul class='wesp-form'>
	    <?php foreach($w_details as $row){?>
		  <input id="id" name="id" type="hidden" value="<?php echo $row->id;?>"/> 
        <li>
            <label for="company">Company Name</label>
            <input id="company" name="company" class="text field" value="<?php echo $row->company;?>"/>
        </li><li>
            <label for="exp_skill">Expierence Skill</label>
            <input id="exp_skill" name="exp_skill" class="text field" value="<?php echo $row->exp_skill;?>"/>
        </li>
		 <li>
            <label for="from_date">From</label>
            <select name='from_date' id='from_date' class="text field">
	 		 <?php echo year_select($row->from_date); ?>
	  		</select>
        </li><li>
            <label for="to_date">To</label>
             <select name='to_date' id='to_date' class="field">
	 		 <?php echo year_select($row->to_date); ?>
	  		</select>
        </li>
		
		<li>
            <label for="country_id">Country</label>
           <select name='country_id' id='country_id' class="field">
	 		 <?php echo selectBox('Select','country','id,name','status="1"',$row->country_id); ?>
	  		</select>
        </li>
		 <li>
            <label for="first_name">State</label>
            <input id="state" name="state" class="text field" value="<?php echo $row->state;?>"/>
        </li><li>
            <label for="zip">Zip Code</label>
            <input id="zip" name="zip" class="text field" value="<?php echo $row->zip;?>"/>
        </li>
		<?php }?>
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
</form>
</div>