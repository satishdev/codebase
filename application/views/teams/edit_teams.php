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
			alphanumeric: true,
			},
			city: {required: true},
			 sports_id: {required: true},
			//description: {required: true},
			level_id: {required: true}/*,
			about_me: {required: true}*/
		},
		messages: {
			name: {required: "Please enter Name"},
			city: {required: "Please enter City"},
			sports_id: {required: "Please select Sports Type"},
			//description: {required: "Please enter description"},
			level_id: {required: "Please enter level"}/*,
			about_me: {required: "Please enter about me"}*/
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Edit Team</div>
</div>

<div id='content_wrapper' class="pad">
<?php if($team_data){?>
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teams/edit_teams');?>" name="appl_form">
<input id="id" name="id" value="<?php echo $team_data->id;?>" type="hidden"/>
    <ul class='wesp-form'>
        <li>
            <label for="name">Name</label>
			<input id="name" name="name" class="text field required" value="<?php echo $team_data->name;?>" type="text"/>
        </li>
		<li>
            <label for="intersts_id">Sport Name</label>
            <select name='sports_id' id='sports_id' class="text field required">
            <?php echo selectBox('Select','sports','id,name','status="1"',$team_data->sports_id,'name'); ?>
            </select>
        </li>
		  <li>
            <label for="city">City</label>
			<input id="city" name="city" class="text field required" value="<?php echo $team_data->city;?>" type="text"/>
        </li>
		<li>
            <label for="description">Description</label>
           	<textarea name="description" id="description"><?php echo $team_data->description;?></textarea>
        </li>
		 <li>
            <label for="level">Level</label>
			<select name='level_id' id='level_id' class="text field required">
            <?php echo selectBox('Select','levels','id,name','status="1"',$team_data->level_id,'name'); ?>
            </select>
        </li>
		<li>
            <label for="about_me">About Team</label>
           <textarea name="about_me" id="about_me"><?php echo $team_data->about_me;?></textarea>
        </li>
		<li>
            <label for="logo1">Logo</label>
			<input type="file" id="logo1" name="logo1"  value=""/>
        </li>		
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
<?php } ?>
</div>