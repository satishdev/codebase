<script>
$(document).ready(function() {
$('#start_date').timepicker({
	ampm: true
	//hourMin: 8,
	//hourMax: 16
});
$('#end_date').timepicker({
	ampm: true
	//hourMin: 8,
	//hourMax: 16
});


	$("#appl_form").validate({
		rules: {
			name: {
				required: true,
			},
			court_no: {
				required: true,
			}
		},
		messages: {
			name: {
				required: "Please enter Court Name",
			},
			court_no: {
				required: "Please enter Court Number",
			}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Add Courts</div>
</div>
<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/add_courts');?>" suc_msg="Player Register: Submited Successfully.">
<input id="" name="rel" class="text" type="hidden" value="player_reg"/>
    <ul class='wesp-form'>
		 <li>
            <label for="name">Name</label>
            <input id="name" name="name" class="text field required" value=""/>
        </li><li>
            <label for="court_no">Court no</label>
            <input id="court_no" name="court_no" class="text field required" value=""/>
        </li>
		 <li>
            <label for="start_date">Start time</label>
            <input id="start_date" name="start_date" class="text field required" readonly="readonly" value=""/>
        </li><li>
            <label for="end_date">End time</label>
            <input id="end_date" name="end_date" class="text field required" readonly="readonly" value=""/>
        </li>
		 <li>
            <label for="sports_id">Sports</label>
          <!--  <input id="sports_id" name="sports_id" class="text field" value=""/>-->
			<select name='sports_id' class="text field required" id='sports_id' />
			<option value="">Select</option>
            <?php foreach($s_data as $row){
				echo "<option value='".$row->id."'>".$row->name."</option>";
			} ?>
            </select>
        </li><li>
            <label for="court_types_id">Court Types</label>
            <!--<input id="court_types_id" name="court_types_id" class="text field" value=""/>-->
			<select name='court_types_id' class="text field required" id='court_types_id' />
            <?php echo selectBox('Select', 'court_types', 'id,name', 'status="1"', '', 'name'); ?>
            </select>
        </li>
		
		
		<!--<li>
            <label for="country_id">Country</label>
			<select id="country_id" name="country_id" class="field required">
               <?php echo selectBox('Select','country','id,name','status="1"',''); ?>
            </select>
        </li>-->
		
		<li>
            <label for="width">Width</label>
            <input id="width" name="width" class="text field required" value=""/>
        </li>
		<li>
            <label for="last_name">Height</label>
            <input id="height" name="height" class="text field required" value=""/>
        </li>
		<li>
            <label for="area">Area</label>
            <input id="area" name="area" class="text field required" value=""/>
        </li>
		<li>
            <label for="terms">Terms</label>
			<textarea id="terms" name="terms" class="required"></textarea>
        </li>
		<li>
            <label for="notes">Notes</label>
			<textarea id="notes" name="notes" class="required"></textarea>
        </li>
		
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
    
</form>
</div>