<?php //print_r($sports_data);?>
<div id='content_header'>
	<div class='hdr-text'><?php if($this->userType==2) echo "My Teams";else echo "Teams";?></div>
    <?php if($this->userType==2) echo smallButton(array('label'=>'Join teams', 'href'=>site_url('teams/allteams/'))); ?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper team">
        <?php if($total>0){foreach($sports_data as $row){?>
        	<div class='contact_card fl'>
                <div class='contact_left'>
                    <div class="image_area">
                    <img class="contact_img" src="<?php echo base_url(); ?><?php if($row->logo!='') echo 'images/teams/th_'.$row->logo;else echo "css/images/no_team.jpg";?>" height="60px" width="60px" />
                    </div>
                </div>
                <div class='contact_right'>
                    <div class='line c1'><h3><?php echo $row->tname;?></h3></div>
                    <div class='line c2'><?php echo $row->sname;?></div>
                   <?php if($this->userType==2){?> <div class='line c3'>Players: <?php echo $row->cnt; ?></div>
                    <div class='more'><a href="<?php echo site_url('teams/viewteam/'.$row->tid);?>">More..</a></div><?php } ?>
                </div>
               <?php if($this->userType==2){?> <div class='contact_ftr'>
                    <div class='owner'>Captain: <?php echo $row->captain; ?></div>
                    <?php
					$txt = 'Add';
					$status = 'a';
					if($row->is_approved!=''){
						if($row->is_approved=='0'){
							$txt = 'Waiting for Approval';
							$status = 'w';
						}else{
							$txt = 'Remove';
							$status = 'r';
						}
					}if($row->is_owner==0){?>
                    <a class='act-status' rel='<?php echo $row->tid;?>' status='<?php echo $status; ?>'><?php echo $txt; ?></a><? } ?>
                </div><?php } ?>
            </div>
        <?php } 
		} else{
		?>
		<div class='contact_card fl'>
             No Teams Found
            </div>
			<?php } ?>
        <div class="clear"></div>
    </div>
<?php echo $this->pagination->create_links();	?>
    <!--<div id="pager_wrap">
        <div class="pager fr">
            <div id="pager_prev" class="page_box fl">&nbsp;</div>
            <div class="page_box fl">1</div>
            <?php echo $this->pagination->create_links();	?>
            <div id="pager_next" class="page_box fl">&nbsp;</div>
        </div>
    </div>-->
</div>