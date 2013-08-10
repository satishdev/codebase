<script type="text/javascript">
	$(function() {
		var d=new Date();
		var ll=d.getFullYear()-100;
		var hh=d.getFullYear();
		$('#dob').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true, maxDate: "+0M",yearRange: ll+':'+hh});
	});
</script>
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
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Personal Info</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/edit');?>" suc_msg="Player Register: Submited Successfully.">
<input id="" name="rel" class="text" type="hidden" value="player_reg"/>
    <ul class='wesp-form'>
	     <li>
            <label for="email">Email</label>
            <?php echo $u_details->email;?>
        </li>
      <?php /*?>  <li>
            <label for="first_name">First Name</label>
            <input id="first_name" name="first_name" class="text field" value="<?php echo $u_details->first_name;?>"/>
        </li>
        <li>
            <label for="last_name">Last Name</label>
            <input id="last_name" name="last_name" class="text field" value="<?php echo $u_details->last_name;?>"/>
        </li><?php */?>	
		<li>
            <label for="last_name">Skype id</label>
            <input id="skype_id" name="skype_id" class="text field" value="<?php echo $u_details->skype_id;?>"/>
        </li>
		<li>
            <label for="last_name">Facebook id</label>
            <input id="facebook_id" name="facebook_id" class="text field" value="<?php echo $u_details->facebook_id;?>"/>
        </li>
		<li>
            <label for="last_name">Twitter id</label>
            <input id="twitter_id" name="twitter_id" class="text field" value="<?php echo $u_details->twitter_id;?>"/>
        </li>
		<li>
            <label for="last_name">Linkedin id</label>
            <input id="linkedin_id" name="linkedin_id" class="text field" value="<?php echo $u_details->linkedin_id;?>"/>
        </li>
		<!-- <li>
            <label for="first_name">Mobile</label>
            <input id="mobile" name="mobile" class="text field" value="<?php echo $u_details->mobile!=0? $u_details->mobile:'';?>"/>
        </li>-->
		<li>
            <label for="last_name">Phone No</label>
            <input id="phone" name="phone" class="text field" value="<?php echo $u_details->phone!=0? $u_details->phone:'';?>"/>
        </li>
		<!-- <li>
            <label for="first_name">Zip</label>
            <input id="zip" name="zip" class="text field" value="<?php echo $u_details->zip!=0? $u_details->zip:'';?>"/>
        </li>-->
		<!--<li>
            <label for="last_name">City</label>
            <input id="city" name="city" class="text field" value="<?php echo $u_details->city!='0'? $u_details->city:'';?>"/>
        </li>
		 <li>
            <label for="first_name">State</label>
            <input id="state" name="state" class="text field" value="<?php echo $u_details->state;?>"/>
        </li><li>
            <label for="last_name">Website</label>
            <input id="web_site" name="web_site" class="text field" value="<?php echo $u_details->web_site;?>"/>
        </li>-->
		<!-- <li>
            <label for="height">Height</label>
            <input id="height" name="height" class="text field" value="<?php //echo $u_details->height;?>"/>
        </li>-->
		<!--<li>
            <label for="weight">Weight</label>
            <input id="weight" name="weight" class="text field" value="<?php //echo $u_details->weight;?>"/>
        </li>-->
		<!-- <li>
            <label for="address">Address</label>
			<textarea id="address" name="address"><?php echo $u_details->address;?></textarea>
        </li><li>
            <label for="about_me">About me</label>
			<textarea id="about_me" name="about_me"><?php echo $u_details->about_me;?></textarea>
        </li>-->
		<li>
		<label for="dob">DOB</label>
                <input type="text" id="dob" name="dob" readonly="readonly" class="text field apply_datepicker" value="<?php echo date('Y-m-d',strtotime($u_details->dob));?>"/>
				</li>
	<?php /*?>	 <li>
            <label for="gender">Gender</label>
           <!-- <input id="gender" name="gender" type="radio" value="m" <?php if($u_details->gender=='m')echo 'checked="checked"';?>/>Male&nbsp;<input id="gender" name="gender" type="radio" value="f" <?php if($u_details->gender=='f')echo 'checked="checked"';?>/>Female-->
			<select id="gender" name="gender" class="field">
                	<option value="m" <?php if($u_details->gender=='m') echo 'selected="selected"';?>>Male</option>
                    <option value="f" <?php if($u_details->gender=='f') echo 'selected="selected"';?>>Female</option>
                </select>
        </li><?php */?>
        <!--<li>
            <label for="smoking">Smoking</label>
             <input id="smoking" name="smoking" type="radio" value="y" <?php if($u_details->smoking=='y')echo 'checked="checked"';?>/>Yes&nbsp;<input id="smoking" name="smoking" type="radio" value="n" <?php if($u_details->smoking=='n')echo 'checked="checked"';?>/>No&nbsp;<input id="smoking" name="smoking" type="radio" value="p" <?php if($u_details->smoking=='p')echo 'checked="checked"';?>/>Other
        </li>-->
		 <!--<li>
            <label for="drinking">Drinking</label>
           <input id="drinking" name="drinking" type="radio" value="y" <?php if($u_details->drinking=='y')echo 'checked="checked"';?>/>Yes&nbsp;<input id="drinking" name="drinking" type="radio" value="n" <?php if($u_details->drinking=='n')echo 'checked="checked"';?>/>No&nbsp;<input id="drinking" name="drinking" type="radio" value="p" <?php if($u_details->drinking=='p')echo 'checked="checked"';?>/>Other
        </li>-->
		<?php /*?><li>
            <label for="country_id">Country</label>
			<select id="country_id" name="country_id" class="field">
               <?php echo selectBox('Select','country','id,name','status="1"',$u_details->country_id); ?>
            </select>
        </li><?php */?>
		
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
    
</form>
</div>