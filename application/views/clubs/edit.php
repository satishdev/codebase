<script>
$(document).ready(function() {/*

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
*/});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Edit Club Info</div>
</div>
<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/edit');?>" suc_msg="Player Register: Submited Successfully.">
<input id="" name="rel" class="text" type="hidden" value="player_reg"/>
    <ul class='wesp-form'>
	<li>
            <label for="description1">Description</label>
			<textarea id="description1" name="description1"><?php echo $u_details->description1;?></textarea>
        </li>
		 <li>
            <label for="first_name">Mobile</label>
            <input id="mobile" name="mobile" class="text field" value="<?php echo $u_details->mobile!=0? $u_details->mobile:'';?>"/>
        </li><li>
            <label for="last_name">Phone</label>
            <input id="phone" name="phone" class="text field" value="<?php echo $u_details->phone!=0? $u_details->phone:'';?>"/>
        </li>
		 <li>
            <label for="first_name">Zip</label>
            <input id="zip" name="zip" class="text field" value="<?php echo $u_details->zip!=0? $u_details->zip:'';?>"/>
        </li><li>
            <label for="last_name">City</label>
            <input id="city" name="city" class="text field" value="<?php echo $u_details->city!='0'? $u_details->city:'';?>"/>
        </li>
		 <li>
            <label for="first_name">State</label>
            <input id="state" name="state" class="text field" value="<?php echo $u_details->state;?>"/>
        </li><li>
            <label for="last_name">Website</label>
            <input id="web_site" name="web_site" class="text field" value="<?php echo $u_details->web_site;?>"/>
        </li>
		
		 <li>
            <label for="address">Address</label>
			<textarea id="address" name="address"><?php echo $u_details->address;?></textarea>
        </li>
		<li>
            <label for="country_id">Country</label>
			<select id="country_id" name="country_id" class="field">
               <?php echo selectBox('Select','country','id,name','status="1"',$u_details->country_id); ?>
            </select>
        </li>
		<li>
            <label for="no_of_courts">No of courts</label>
            <input id="no_of_courts" name="no_of_courts" class="text field" value="<?php echo $u_details->no_of_courts;?>"/>
        </li>
		<li>
            <label for="width">Width</label>
            <input id="width" name="width" class="text field" value="<?php echo $u_details->width;?>"/>
        </li>
		<li>
            <label for="last_name">Height</label>
            <input id="height" name="height" class="text field" value="<?php echo $u_details->height;?>"/>
        </li>
		<li>
            <label for="area">Area</label>
            <input id="area" name="area" class="text field" value="<?php echo $u_details->area;?>"/>
        </li>
		<li>
            <label for="terms">Terms</label>
			<textarea id="terms" name="terms"><?php echo $u_details->terms;?></textarea>
        </li>
		<li>
            <label for="notes">Notes</label>
			<textarea id="notes" name="notes"><?php echo $u_details->notes;?></textarea>
        </li>
		
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
    
</form>
</div>