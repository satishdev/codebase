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
			sports_id: {required: "Please select Sports Type"},
			city: {required: "Please enter city"},
			/*description: {required: "Please enter description"},*/
			level_id: {required: "Please select level"},
			custom_name: {required: "Please enter Expertise Level Name"}/*,
			about_me: {required: "Please enter about me"}*/
		}
	});
});

function expertLevelChange(me){
	var me = $(me);
	if(me.val() == "custom"){
		$('#custom_name').replaceWith("<input type='text' name='custom_name' class='text field required' id='custom_name' />");
		me.closest('li').find('.custom-list').slideDown();
	}else{
		me.closest('li').find('.custom-list').slideUp();
		$('#custom_name').replaceWith("<input type='text' name='custom_name' class='text field' id='custom_name' />");
	}
}
</script>
<div id='content_header'>
	<div class='hdr-text'>Create Team</div>
	<?php if($this->userType==2) echo smallButton(array('label'=>'Join teams', 'href'=>site_url('teams/allteams/'))); ?>
</div>

<div id='content_wrapper' class="pad">
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('teams/add_teams');?>" name="appl_form">
    <ul class='wesp-form'>
        <li>
            <label for="name">Name</label>
			<input  type="text" name="name" class="text field required" id="name" />
        </li>
		<li>
            <label for="intersts_id">Sport Name</label>
            <select name='sports_id' class="text field required" id='sports_id'>
           <?php if($this->userType==2){echo $this->teams_model->sportsSelectBox($this->userId);}else{
		    echo $this->teams_model->sportsSelectBoxClub($this->clubId);
		   } ?>
            </select>
        </li>
		 <li>
            <label for="city">City</label>
			<input  type="text" name="city" value="" class="text field required" id="city" />
        </li>
		<li>
            <label for="description">Description</label>
           	<textarea name="description"  id="description"></textarea>
        </li>
		 <li>
            <label for="level">Expertise Level</label>
			<select name='level_id' class="text field required" id='level_id' onchange="expertLevelChange(this)">
            <?php echo selectBox('Select', 'levels', 'id,name', 'status="1"', '', 'recommend,id', true); ?>
            </select>
            <div class="clear"></div>
            <ul class='custom-list' style='display:none'>
            	<li>
                    <label for="custom_name">Expertise Level Name</label>
                    <input type="text" name="custom_name" class="text field" id="custom_name" />
                </li>
                <li class='no-lbl'>
                	<input type="checkbox" name="recommend" id="recommend" value="1">
                    <label for="recommend">Recommend</label>
                </li>
            </ul>
        </li>
		<li>
            <label for="about_me">About Team</label>
            <textarea name="about_me"  id="about_me"></textarea>
        </li>
		<li>
            <label for="logo1">Logo</label>
			<input type="file" name="logo1" class="field " id="logo1" />
        </li>		
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
</div>