<script type="text/javascript" language="javascript">
    wesport.sports_list = "<?php echo selectBox('Select','sports_types','id,name','status="1"','', "name asc"); ?>";
</script>
<script>
$(document).ready(function() {
 $.validator.addMethod("alphanumeric", function(value, element, params) {
                        var pattern = /^[A-Za-z][A-Za-z0-9]*$/;
                        return pattern.test(value); 
                    }, "Alphanumeric only allowed"); 
	$("#appl_form").validate({
		rules: {
            sports_id: {required: true},
            expert_id: {required: true},
			name: {
			required: true,
			alphanumeric: true,
			},
            sports_type_id: {required: true},
           /* logo1: {required: true},
			description: {required: true},*/
            custom_name: {required: true}
		},
		messages: {
            sports_id: {required: "Please Select Sport Name"},
            expert_id: {required: "Please Select Expertise Level"},
			name: {required: "Please Enter Name"},
            sports_type_id: {required: "Please Select Sport Type"},
          /*  logo1: {required: "Please Enter Logo"},
			description: {required: "Please Enter Description"},*/
            custom_name: {required: "Please Enter Expertise Level Name"}		
		}
	});
});	
function expertLevelChange(me){
	var me = $(me);
	if(me.val() == "custom"){
    	me.closest('li').find('.custom-list').html(addCustomSportExpertise()).slideDown();
	}else{
		me.closest('li').find('.custom-list').slideUp(function(){
            $(this).html("");
        });
	}
}
function sp_expertLevelChange(me){
	var me = $(me);
	if(me.val() == "custom"){
		me.closest('li').find('.custom-list-sports').html(addCustomSport()).slideDown();
	}else{
		me.closest('li').find('.custom-list-sports').slideUp(function(){
            $(this).html("");
        });
	}
}


function addCustomSport(){
    var sport = [];

    sport.push('<li><label for="name">Name</label><input id="name" name="name" class="text field" value="" type="text"/></li>');
    sport.push('<li><label for="sports_type_id">Sport Type</label><select name="sports_type_id" id="sports_type_id" class="text field">'+wesport.sports_list+'</select></li>');
    sport.push('<li><label for="description">Description</label><textarea name="description" id="description"></textarea></li>');
    sport.push('<li><label for="logo1">Logo</label><input type="file" id="logo1" name="logo1" class="field"  value=""/></li>');
    sport.push('<li class="no-lbl"><input type="checkbox" id="recommend" name="recommend" value="1" /><label for=recommend>Recommend</label></li>');

    return sport.join("");
}

function addCustomSportExpertise(){
    var exp = [];

    exp.push('<li><label for="custom_name">Expertise Level Name</label><input type="text" name="custom_name" class="text field" id="custom_name" /></li>');
    exp.push('<li class="no-lbl"><input type="checkbox" name="ex_recommend" id="ex_recommend" value="1"><label for="ex_recommend">Recommend</label></li>');

    return exp.join("");
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
            <label for="sports_id">Sport Name</label>
			 <select name='sports_id' id='sports_id' class="text field" onchange="sp_expertLevelChange(this)">
            <?php echo selectBox('Select','sports','id,name','status="1"','',"name asc",true); ?>
            </select>
            <div class="clear"></div>
            <ul class='custom-list-sports' style='display:none'></ul>
        </li>    
		<li>
            <label for="expert_id">Expertise Level</label>
			<select name='expert_id' class="text field required" id='expert_id' onchange="expertLevelChange(this)">
            <?php echo selectBox('Select', 'levels', 'id,name', 'status="1"', '', 'recommend,id', true); ?>
            </select>
            <div class="clear"></div>
            <ul class='custom-list' style='display:none'></ul>
        </li> 
        
        <li class="frm-btns">
			<input type="submit" value="submit" name="submit" class="button_img" />
        </li>
    </ul>
</form>
</div>