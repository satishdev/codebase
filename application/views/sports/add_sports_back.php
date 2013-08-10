<script>
$(document).ready(function() {
	$("#appl_form").validate({
		rules: {
			name: {required: true},
			description: {required: true}
		},
		messages: {
			name: {required: "Please enter name"},
			description: {required: "Please enter description"}			
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
function sp_expertLevelChange(me){
	var me = $(me);
	if(me.val() == "custom"){
		//$('.custom-list-sports').replaceWith("<input type='text' name='custom_name' class='text field required' id='custom_name' />");
		me.closest('li').find('.custom-list-sports').slideDown();
	}else{
		me.closest('li').find('.custom-list-sports').slideUp();
		//$('#custom_name').replaceWith("<input type='text' name='custom_name' class='text field' id='custom_name' />");
	}
}
</script>

<div id='content_header'>
	<div class='hdr-text'>Add New Sport</div>
	<?php if($this->userType==2) echo smallButton(array('label'=>'Available Sports', 'href'=>site_url('sports/allsports/'))); ?>
</div>

<div id='content_wrapper' class='pad'>
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('sports/add_sports');?>" name="appl_form">
    <ul class='wesp-form'>	
		
		<li>
            <label for="intersts_id">Sports Name</label>
			 <select name='sports_id' id='sports_id' class="text field" onchange="sp_expertLevelChange(this)">
            <?php echo selectBox('Select','sports','id,name','status="1"','',"name asc",true); ?>
            </select>
            <div class="clear"></div>
            <ul class='custom-list-sports' style='display:none'>
            	<li>
            <label for="intersts_id">Name</label>
			<input id="name" name="name" class="text field" value="" type="text"/>
        </li>
        <li>
            <label for="intersts_id">Sports Type</label>
            <select name='sports_type_id' id='sports_type_id' class="text field">
            <?php echo selectBox('Select','sports_types','id,name','status="1"','',"name='Other Sports', name asc"); ?>
            </select>
        </li>
		<li>
            <label for="description">Description</label>
           	<textarea name="description" id="description"></textarea>
        </li>
		<li>
            <label for="logo1">Logo</label>
			<input type="file" id="logo1" name="logo1" class="field"  value=""/>
        </li>
        <li class='no-lbl'>
        	<input type='checkbox' id='recommend' name='recommend' value="1" /><label for='recommend'>Recommend</label>
        </li>
            </ul>
        </li>    
		<li>
            <label for="level">Expertise Level</label>
			<select name='expert_id' class="text field required" id='expert_id' onchange="expertLevelChange(this)">
            <?php echo selectBox('Select', 'levels', 'id,name', 'status="1"', '', 'name', true); ?>
            </select>
            <div class="clear"></div>
            <ul class='custom-list' style='display:none'>
            	<li>
                    <label for="custom_name">Expertise Level Name</label>
                    <input type="text" name="custom_name" class="text field" id="custom_name" />
                </li>
                <li class='no-lbl'>
                	<input type="checkbox" name="ex_recommend" id="ex_recommend" value="1">
                    <label for="ex_recommend">Recommend</label>
                </li>
            </ul>
        </li> 
        
        <li class="frm-btns">
			<input type="submit" value="submit" name="submit" class="button_img" />
        </li>
    </ul>
</form>
</div>