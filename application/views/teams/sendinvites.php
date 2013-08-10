<script>
$(document).ready(function() {

/*$("#appl_form").validate({
    rules: {
       to_id: {required: true}
    },
    messages: {
        to_id: {required: "Please select to"}
    }
});*/

$('.n_act.invite_player').die('click').live('click', function(){
    var me = $(this), param = [];
	
	param.push("player_id="+me.closest('.msg_actions').attr('rel'));
	param.push("tid="+$('#tid').val());
	$.ajax({
		url:site_url+'teams/sendinviteuser',
		data:param.join("&"),
		type:'POST',
		dataType:'json',
		beforeSend:function(){
			me.html("loading...")
		},
		success:function(dataR){
		if(dataR==1){
			me.closest('.act_wrap').html('Invitation has been Sent');
			}else if(dataR==0){
		me.closest('.act_wrap').html('Invitation Already Sent');
		}
		}
	});
});

});	
</script>
<?php if($teamDetails){?>
<div id='content_header'>
	<div class='hdr-text'>Invite Players for <?php echo anchor('teams/viewteam/'.$teamDetails->id,$teamDetails->name);?></div>
</div>

<div id='content_wrapper'>
    <div id="notifications" class="notifications multi-selection">
        <form id="appl_form" method="post" action="<?php echo site_url('teams/sendinvites');?>" name="appl_form" class='wesp-form'>
		<input type="hidden" id="tid" name="tid" value="<?php echo $teamDetails->id;?>" />
        <?php if(count($teamusers)>0){ foreach($teamusers as $row){ ?>
            <div class="msg_item player">
            <!--<input type="checkbox" class='u_select' name="player_id[]" value="<?php echo $row->pid ?>" />-->
            <a href="<?php echo site_url('profile/view/'.$row->pid);?>"> <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>"></a>
            <div class="msg_data">
                <div class="u_name"><a href="<?php echo site_url('profile/view/'.$row->pid);?>"><?php echo $row->pname;?></a></div>
                <div class="u_msg">Player Description</div>
                <div class="msg_actions" rel='<?php echo $row->pid;?>'>
                    <div class='n_actions'>
                        <div class='act_wrap'><?php if($row->tuser==0){?><a class='n_act invite_player main'>Invite</a><?php } else{?>Invitation has been Sent<?php }?></div>
                        <div class='clear'></div>
                    </div>
                </div>
							
            </div>
            </div>
        <?php } ?>
       <!-- <div class='frm-btns'>
        	<input type="submit" value="Invite" name="submit" class="button_img" />
        </div>-->
        <?php }else{?>
            <div class="msg_item">
            No records found
            </div>
        <?php } ?>
       
        </form>
    </div>
</div>
<?php } ?>