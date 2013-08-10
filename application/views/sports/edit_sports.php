<script>
$(document).ready(function() {
$.validator.addMethod("alphanumeric", function(value, element, params) {
                        var pattern = /^[A-Za-z][A-Za-z0-9]*$/;
                        return pattern.test(value); 
                    }, "Alphanumeric only allowed"); 
	$("#appl_form").validate({
		rules: {
			name: {
			required: true,
			alphanumeric: true
			},
			description: {required: true}			
		},
		messages: {
			name: {required: "Please enter name"},
			description: {required: "Please enter description"}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Edit Sport</div>
</div>

<div id='content_wrapper' class='pad'>
<?php if($sp_data){?>
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('sports/edit_sports');?>" name="appl_form">
<input id="id" name="id" value="<?php echo $sp_data->sid;?>" type="hidden"/>
<input id="sdid" name="sdid" value="<?php echo $sp_data->sdid;?>" type="hidden"/>
    <ul class='wesp-form'>
        <li>
            <label for="intersts_id">Name</label>
			<input id="name" name="name" class="text field" value="<?php echo $sp_data->sname;?>" type="text"/>
        </li>
		<li>
            <label for="intersts_id">Sports Type</label>
            <select name='sports_type_id' id='sports_type_id' class="text field">
            <?php echo selectBox('Select','sports_types','id,name','status="1"',$sp_data->sports_type_id); ?>
            </select>
        </li>
		<li>
            <label for="description">Description</label>
           	<textarea name="description" id="description"><?php echo $sp_data->description;?></textarea>
        </li>
		<li>
            <label for="logo1">Logo</label>
			<input type="file" id="logo1" name="logo1"  value=""/>
        </li>
        <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
</form>
<?php } ?>
</div>