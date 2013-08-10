<script>
$(document).ready(function() {

       $("#appl_form").validate({
		rules: {
		   to_id: {required: true},
		   subject: {required: true},
		   message: {required: true}
		},
		messages: {
			to_id: {required: "Please select to"},
		    subject: {required: "Please enter subject"},
		    message: {required: "Please enter Message"}
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'>Compose</div>
</div>

<div id='content_wrapper' class='pad'>
<form id="appl_form" method="post" action="<?php echo site_url('inbox/compose');?>" name="appl_form">
    <ul class='wesp-form'>	   
        <li class='overflow'>
            <label for="to">To</label>
           <!-- <input id="to" name="to" class="text" value=""/>-->
		    <select name='to_id[]' id='to_id' class="chzn-select text field" multiple="multiple">
	 		 <?php $friends=$this->users_model->composeFriends($this->userId); 
			 foreach($friends as $frd){
			 echo "<option value='".$frd->id."'>".$frd->email."</option>";
			 }//echo selectBox('','players','id,email','status="1" and player_types_id="2" and id!="'.$this->userId.'"',''); ?>
	  		</select>
        </li>
		 <li>
            <label for="subject">Subject</label>
            <input id="subject" name="subject" class="text field" value=""/>
        </li>
		<li>
            <label for="message">Body</label>
			<textarea name="message" id="message"></textarea>
        </li>
        <li class='frm-btns'>
			<input type="submit" value="Send" name="submit" class="button_img" />
        </li>
    </ul>
<link rel="stylesheet" href="<?php echo base_url();?>css/chosen.css" />
<script src="<?php echo base_url();?>js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript"> $(".chzn-select").chosen();  </script>
</form>
</div>