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
	$obj['options'][] = array('id'=>'inbox_invitations', 'label'=>'Invitations ('.count($frends_data).')', 'href'=>site_url('inbox/invitation'), 'active'=>true);
	$obj['options'][] = array('id'=>'inbox_notifications', 'label'=>'Notifications', 'href'=>site_url('inbox/notifications'));
    echo horizontalTab($obj);
	?>
</div>

<div id="content_wrapper">
<div id="notifications" class="notifications">
<?php if($total_rows>0){ foreach($frends_data as $row){ ?>
	<div class="msg_item player">
    <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo $row->is_type == 2?'images/teams/th_'.$row->image:'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>">
    <div class="msg_data">
    	<div class="u_name"><?php echo $row->pname;?></div>
        <div class="u_msg">
        	<?php
				$msg = "Add me as your Sports Friend";
				$btnText = "Accept";
				$ntype = 1;
            	if($row->is_type == 2){
					$msg = "You are requested to join ".$row->pname.".";
					$btnText = "Join Team";
					$ntype = 2;
				}else if($row->is_type == 3){
					$msg = "Hi, you are requested to join this Club.";
					$btnText = "Join Club";
					$ntype = 3;
				}
			?>
			<?php echo $msg; ?>
		</div>
        <div class="msg_actions" rel='<?php echo $row->pid;?>' ntype="<?php echo $ntype;?>">
        	<div class='n_actions'>
            	<div class='act_wrap'><a class='n_act btn main' status='2'><?php echo $btnText; ?></a></div>
                <div class='act_wrap'><a class='n_act btn' status='1'>Reject</a></div>
                <div class='clear'></div>
            </div>
        </div>
    </div>
    </div>
<?php } }else{?>
	<div class="msg_item">
    No records found
    </div>
<?php } ?>
</div>
</div>
