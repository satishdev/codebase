<script type="text/javascript" language="javascript">
	wesport = {};
	wesport.relations = <?php echo isset($plrelation)?$plrelation:"[]"; ?>;
	wesport.team_relations = <?php echo isset($teamrelation)?$teamrelation:"[]"; ?>
</script>
<div id='content_header'>
	<div class='hdr-text'>Inbox</div>
    <?php
	$obj = array();
	$obj['options'][] = array('id'=>'inbox_messages', 'label'=>'Messages', 'href'=>site_url('inbox'));
	$obj['options'][] = array('id'=>'inbox_invitations', 'label'=>'Invitations', 'href'=>site_url('inbox/invitation'));
	$obj['options'][] = array('id'=>'inbox_notifications', 'label'=>'Notifications', 'href'=>site_url('inbox/notifications'), 'active'=>true);
    echo horizontalTab($obj);
	?>
</div>

<div id="content_wrapper">
<div id="notifications" class="notifications">
<?php if($total_rows>0){ foreach($notify_data as $row){ ?>
	<div class="msg_item player">
    <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>">
    <div class="msg_data">
	<div class="u_name"><?php echo $row->pname;?></div>
        <div class="u_msg">
        	<?php
			if($row->schedule_type=='2'){
				$msg = "Hi, ".$row->pname." as added the match with you on ".$row->start_date." from ".$row->end_date." at ".$row->cname.", ".$row->crtsname;
				}else if($row->schedule_type=='3'){
				$tnames=$this->inbox_model->schedulematch_teams($row->sch_id);
				$team_data='';
				foreach($tnames as $t){
					$team_data.=$t->tname." and ";
				}
				$msg = "Hi, ".$row->pname." as added the match with teams ".trim($team_data,' and ')." on ".$row->start_date." from ".$row->end_date." at ".$row->cname.", ".$row->crtsname;
				}else if($row->schedule_type=='5'){
				$msg = "Hi, add me in your team ".$row->cname;
				$btnText = "Approve";
				$ntype = 5;
				}else if($row->schedule_type=='6'){
				$msg = "Please update your match Result";
				$btnText = "Approve";
				$ntype = 6;
				}else if($row->schedule_type=='7'){
				$msg = "Please update your match Result";
				$btnText = "Approve";
				$ntype = 7;
				}
				
			?>
			<?php echo $msg; ?>
		</div>
		<?php if(($row->schedule_type=='2' || $row->schedule_type=='3') && ($row->team_cpt==0 || $row->team_cpt==$this->userId)){ ?>
        <div class="msg_actions" rel='<?php echo $row->id;?>' ntype="<?=$row->schedule_type?>">
        	<div class='n_actions'>
            	<div class='act_wrap'><a class='n_act btn_schedule main' status='2'>Accept</a></div>
                <div class='act_wrap'><a class='n_act btn_schedule main' status='1'>Decline</a></div>
                <div class='clear'></div>
            </div>
        </div>
		<?php } else if($row->schedule_type=='5'){?>
		<div class="msg_actions" rel='<?php echo $row->sch_id;?>' uid='<?php echo $row->id;?>' ntype="<?php echo $ntype;?>">
        	<div class='n_actions'>
            		<div class='act_wrap'><a class='n_act btn_schedule main' status='2'>Accept</a></div>
                <div class='act_wrap'><a class='n_act btn_schedule main' status='1'>Decline</a></div>
                <div class='clear'></div>
            </div>
        </div>
		<?php }  else if($row->schedule_type=='6'){
		$res_match=$this->users_model->is_schedule_win_loss($row->sch_id,$this->userId);
		?>
		<div class="msg_actions" rel='<?php echo $row->id;?>' uid='<?php echo $row->id;?>' ntype="<?php echo $ntype;?>">
        	<div class='n_actions'>
			<?php if($res_match==0 || $res_match==2){
			 $res_match_type_w=$res_match==0?1:4;?>
            		<div class='act_wrap'><a class='n_act btn_schedule main' status='<?php echo $res_match_type_w;?>'>Won</a></div>
					<?php } if($res_match==0 || $res_match==1){
					$res_match_type_l=$res_match==0?2:5;?>
                <div class='act_wrap'><a class='n_act btn_schedule main' status='<?php echo $res_match_type_l;?>'>Loss</a></div>
				<?php } if($res_match==0 || $res_match==3){
				$res_match_type_n=$res_match==0?3:6;?>
				<div class='act_wrap'><a class='n_act btn_schedule main' status='<?php echo $res_match_type_n;?>'>No Result</a></div>
				<?php } ?>
                <div class='clear'></div>
            </div>
        </div>
		<?php }  else if($row->schedule_type=='7'){
		$res_match=$this->users_model->is_schedule_win_loss($row->sch_id);?>
		<div class="msg_actions" rel='<?php echo $row->id;?>' uid='<?php echo $row->id;?>' ntype="<?php echo $ntype;?>">
        	<div class='n_actions'>
            		<!--<div class='act_wrap'><a class='n_act btn_schedule main' status='1'>Won</a></div>
                <div class='act_wrap'><a class='n_act btn_schedule main' status='2'>Loss</a></div>
				<div class='act_wrap'><a class='n_act btn_schedule main' status='3'>No Result</a></div>-->
				<?php if($res_match==0 || $res_match==2){
			      $res_match_type_w=$res_match==0?1:4;?>
            		<div class='act_wrap'><a class='n_act btn_schedule main' status='<?php echo $res_match_type_w;?>'>Won</a></div>
					<?php } if($res_match==0 || $res_match==1){
					$res_match_type_l=$res_match==0?2:5;?>
                <div class='act_wrap'><a class='n_act btn_schedule main' status='<?php echo $res_match_type_l;?>'>Loss</a></div>
				<?php } if($res_match==0 || $res_match==3){
				$res_match_type_n=$res_match==0?3:6;?>
				<div class='act_wrap'><a class='n_act btn_schedule main' status='<?php echo $res_match_type_n;?>'>No Result</a></div>
				<?php } ?>
                <div class='clear'></div>
            </div>
        </div>
		<?php } ?>
    </div>
    </div>
<?php } }else{?>
	<div class="msg_item">
    No records found
    </div>
<?php } ?>
</div>
</div>
