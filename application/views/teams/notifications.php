<script type="text/javascript" language="javascript">
	wesport = {};
	wesport.relations = <?php echo isset($plrelation)?$plrelation:"[]"; ?>;
	wesport.team_relations = <?php echo isset($teamrelation)?$teamrelation:"[]"; ?>
</script>
<div id='content_header'>
	<div class='hdr-text'>Notifications</div>
   
</div>

<div id="content_wrapper">
<div id="notifications" class="notifications">
<?php if($total_rows>0){ foreach($notify_data as $row){ ?>
	<div class="msg_item player">
    <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>">
    <div class="msg_data">
    	<div class="u_name"><?php echo $row->uname;?></div>
        <div class="u_msg">
        	<?php
				$msg = "Hi, add me in your team..";
				$btnText = "Approve";
				$ntype = 2;
			?>
			<?php echo $msg; ?>
		</div>
        <div class="msg_actions" rel='<?php echo $row->tid;?>' uid='<?php echo $row->pid;?>' ntype="<?php echo $ntype;?>">
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
