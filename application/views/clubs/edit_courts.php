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
	<div class='hdr-text'>Edit Courts</div>
</div>
<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('clubs/edit_courts');?>" >
<input id="id" name="id" type="hidden" value="<?php echo $c_data->id;?>"/>
<input id="cd_id" name="cd_id" type="hidden" value="<?php echo $c_data->crtd_id;?>"/>
    <ul class='wesp-form'>
		 <li>
            <label for="name">Name</label>
            <input id="name" name="name" class="text field required" value="<?php echo $c_data->name;?>"/>
        </li><li>
            <label for="court_no">Court no</label>
            <input id="court_no" name="court_no" class="text field required" value="<?php echo $c_data->court_no;?>"/>
        </li>
		 <li>
            <label for="start_date">Start time</label>
            <input id="start_date" name="start_date" class="text field required" readonly="readonly" value="<?php echo $c_data->start_date;?>"/>
        </li><li>
            <label for="end_date">End time</label>
            <input id="end_date" name="end_date" class="text field required" readonly="readonly" value="<?php echo $c_data->end_date;?>"/>
        </li>
		 <li>
            <label for="sports_id">Sports</label>
			<select name='sports_id' class="text field required" id='sports_id' />
			<option value="">Select</option>
            <?php foreach($s_data as $row){
			$sel='';
			 if($row->id==$c_data->sports_id){
			 	$sel="selected='selected'";
			 }
				echo "<option value='".$row->id."' ".$sel.">".$row->name."</option>";
			} ?>
            </select>
        </li><li>
            <label for="court_types_id">Court Types</label>
			<select name='court_types_id' class="text field required" id='court_types_id' />
            <?php echo selectBox('Select', 'court_types', 'id,name', 'status="1"', $c_data->court_types_id, 'name'); ?>
            </select>
        </li>
		
	
		
		<li>
            <label for="width">Width</label>
            <input id="width" name="width" class="text field required" value="<?php echo $c_data->width;?>"/>
        </li>
		<li>
            <label for="last_name">Height</label>
            <input id="height" name="height" class="text field required" value="<?php echo $c_data->height;?>"/>
        </li>
		<li>
            <label for="area">Area</label>
            <input id="area" name="area" class="text field required" value="<?php echo $c_data->area;?>"/>
        </li>
		<li>
            <label for="terms">Terms</label>
			<textarea id="terms" name="terms" class="required"><?php echo $c_data->terms;?></textarea>
        </li>
		<li>
            <label for="notes">Notes</label>
			<textarea id="notes" name="notes" class="required"><?php echo $c_data->notes;?></textarea>
        </li>
		
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
    
</form>
</div>